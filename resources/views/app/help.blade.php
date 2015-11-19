@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Help
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-question-circle"></i> Help
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <h2>Supported Tools</h2>
            <p>
                Lorem ipsum dolor sit amet ...
            <ul>
                <li>Recon-ng (<a href="https://bitbucket.org/LaNMaSteR53/recon-ng">https://bitbucket.org/LaNMaSteR53/recon-ng</a>)</li>
                <li>TheHarvester (<a href="https://www.paterva.com/web6/products/maltego.php">https://www.paterva.com/web6/products/maltego.php</a>)</li>
                <li>Cree.py (<a href="http://www.geocreepy.com">http://www.geocreepy.com</a>)</li>
                <li>Maltego (<a href="https://www.paterva.com/web6/products/maltego.php">https://www.paterva.com/web6/products/maltego.php</a>)</li>
            </ul>
            </p>
            <h2>How can I use the tools?</h2>
            {{-- TODO: Add Maltego help --}}
            <h3>Recon-ng</h3>
            <ul>
                <li>Find hosts</li>
                <ul>
                    <li>Find hosts by using the module <code>bing_domain_web</code></li>
                    <li>Find more hosts <code>recon/domains-hosts/netcraft</code></li>
                </ul>
                <li>Gather IP addresses</li>
                <ul>
                    <li>Gather the corresponding ip addresses by using the module <code>recon/hosts-hosts/resolve</code></li>
                    <li>Find additional hosts based on ip addresses <code>recon/hosts-hosts/reverse_resolve</code></li>
                </ul>
                <li>Get locations to IP addresses</li>
                <ul>
                    <li>Execute <code>recon/hosts-hosts/freegeoip</code></li>
                </ul>
                <li>Find contacts connected to domains</li>
                <ul>
                    <li>Execute <code>recon/domains-contacts/whois_pocs</code></li>
                    <li>Execute <code>recon/companies-profiles/bing_linkedin</code> after setting <code>SOURCE=%Company%</code> [Requires API Key}</li>
                    <li>Execute <code>recon/profiles-profiles/linkedin_crawl</code></li>
                </ul>
                <li>Get Domains</li>
                <ul>
                    <li>Get Domains from email addresses <code>recon/contacts-domains/migrate_contacts</code></li>
                </ul>
                <li>Get Locations</li>
                <ul>
                    <li></li>
                    <li>Get Streetnames for locations <code>recon/locations-locations/geocode</code></li>
                </ul>
                <li>Export data as json</li>
                <ul>
                    <li>Load <code>reporting/json</code></li>
                    <li><code>set FILENAME /path/filename.json</code></li>
                    <li><code>set TABLES hosts, contacts, profiles, credentials</code></li>
                    <li>Execute</li>
                </ul>
            </ul>
            <h3>TheHarvester</h3>
            <ul>
                <li>Find PGP Keys</li>
                <ul>
                    <li>Execute <code>theharvester -d %DOMAIN% -b all -f %filename.xml%</code></li>
                </ul>
            </ul>
            <h3>Cree.py</h3>
            <ul>
                <li>Start new Project</li>
                <li>Add Accounts (Twitter, Flickr, Instagram, ...)</li>
                <li>Analyze Project for locations</li>
                <li>Export results as KML-File</li>
                <li>Delete the fourth line from the file. It should look like this: <code>&lt;name&gt;&lt;built-in function id&gt;.kml&lt;/name&gt;</code></li>
            </ul>
            <h3>Maltego</h3>
            <p>Lorem ipsum dolor sit amet ...</p>
        </div>
    </div>
    <!-- /.row -->
@stop