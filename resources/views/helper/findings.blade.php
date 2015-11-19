<table class="table table-striped">
    <thead>
        <tr>
            <th style="width: 400px">Finding</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @if($data['attackType'] == 'phishing')
            <tr>
                <td>Gathered internal company documents</td>
                <td>{{ $data['companyLingo'] }}</td>
            </tr>
            <tr>
                <td>Company Locations</td>
                <td>{{ $data['companyLocation'] }}</td>
            </tr>
            <tr>
                <td>Social Media Account Coverage</td>
                <td>{{ $data['socialAccounts'] }}%</td>
            </tr>
        @elseif($data['attackType'] == 'baiting')
            <tr>
                <td>Company Locations</td>
                <td>{{ $data['companyLocation'] }}</td>
            </tr>
            <tr>
                <td>Knowledge about company software</td>
                <td>
                    @if($data['companySoftware'] == 0)
                        No Knowledge
                    @elseif($data['companySoftware'] == 33)
                        Little Knowledge
                    @elseif($data['companySoftware'] == 66)
                        Medium Knowledge
                    @else
                        Extensive Knowledge
                    @endif
                </td>
            </tr>
            <tr>
                <td>Knowledge about company network</td>
                <td>
                    @if($data['companyNetwork'] == 0)
                        No Knowledge
                    @elseif($data['companyNetwork'] == 33)
                        Little Knowledge
                    @elseif($data['companyNetwork'] == 66)
                        Medium Knowledge
                    @else
                        Extensive Knowledge
                    @endif
                </td>
            </tr>
            <tr>
                <td>Knowledge about company security</td>
                <td>
                    @if($data['companySecurity'] == 0)
                        No Knowledge
                    @elseif($data['companySecurity'] == 33)
                        Little Knowledge
                    @elseif($data['companySecurity'] == 66)
                        Medium Knowledge
                    @else
                        Extensive Knowledge
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td>Company Locations</td>
                <td>{{ $data['companyLocation'] }}</td>
            </tr>
            <tr>
                <td>Gathered internal company documents</td>
                <td>{{ $data['companyLingo'] }}</td>
            </tr>
            <tr>
                <td>Social Media Account Coverage</td>
                <td>{{ $data['socialAccounts'] }}%</td>
            </tr>
            <tr>
                <td>Knowledge about company security</td>
                <td>
                    @if($data['companySecurity'] == 0)
                        No Knowledge
                    @elseif($data['companySecurity'] == 33)
                        Little Knowledge
                    @elseif($data['companySecurity'] == 66)
                        Medium Knowledge
                    @else
                        Extensive Knowledge
                    @endif
                </td>
            </tr>
        @endif
    </tbody>
</table>