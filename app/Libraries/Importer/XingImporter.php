<?php
/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 16.10.15
 * Time: 14:16
 */

namespace App\Libraries\Importer;

use App\Libraries\Requests\CurlRequest;
use Illuminate\Support\Facades\Session;
use Nathanmac\Utilities\Parser\Facades\Parser;
use Sunra\PhpSimple\HtmlDomParser;

class XingImporter extends Importer
{

    public  $findings;
    private $importedFile;
    private $profileIds = [];

    /**
     * Import Profiles from a given xing url
     *
     * @param Exported $url
     * @return mixed
     */
    public function import($url)
    {
        $this->findings['profiles']  = [];

        $this->gatherHtmlCode($url);

        return redirect('/api/xing/'.time());
    }

    /**
     * Generate the html code to include all employees
     *
     * NOTE: Limited to 1000 per Letter by the code, to avoid
     * very long waiting times
     *
     * @param $mainUrl
     * @return string
     */
    protected function gatherHtmlCode($mainUrl) {
        $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $sourceCode = "";

        foreach($letters as $letter) {
            $url = $mainUrl.'/employees.json?filter=all&letter='.$letter.'&limit=1000&offset=0&_='.time();
            $html = CurlRequest::getHTML($url);
            $json = Parser::json($html);

            if(isset($json['contacts'][$letter]['html'])) {
                foreach($json['contacts'][$letter]['html'] as $code) {
                    $sourceCode .= $code;
                }
            }
        }

        $this->importedFile = $sourceCode;

        // Analyse current letter
        $this->analyze();

    }

    /**
     * Save all ProfileIDs in Session
     * @return mixed|void
     */
    protected function analyze() {
        $dom = HtmlDomParser::str_get_html( $this->importedFile );

        if(method_exists($dom, 'find')) {
            foreach($dom->find('a.user-name-link') as $element) {
                $url = 'https://www.xing.com'.$element->href;
                $url = substr($url,0,strpos($url, '/',29));
                $url = explode('/', $url);

                // ID is the last part of the splitted URL
                $this->profileIds[] = $url[count($url)-1];
            }
            $savedProfileIDs = Session::get('XingProfileIDs', []);
            $this->profileIds = array_merge($this->profileIds, $savedProfileIDs);
            Session::put('XingProfileIDs', $this->profileIds);
        }
    }
}