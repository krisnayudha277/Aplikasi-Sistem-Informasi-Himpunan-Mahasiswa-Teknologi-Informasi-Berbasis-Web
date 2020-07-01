<?php

//fetch.php

$api_url = "10.200.20.84/uas/rest-api-crud-using-php/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->nama.'</td>
			<td>'.$row->nim.'</td>
			<td>'.$row->status.'</td>
			<td>'.$row->divisi.'</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>