<?php



function tableHeader($a, $b, $c)
{
  echo '
          <table>
          <tr id="header">
          <th style="border-top-left-radius: 12px;">' . $a . '</th>
          <th>' . $b . '</th>
          <th style="border-top-right-radius: 12px;">' . $c . '</th>
          </tr>';
} //to generate table th with different headers

function parseJson($urls)
{
  $c = curl_init($urls);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0");
  curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'/* , "Authorization: token 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" */));
  $content = curl_exec($c);
  return $content;
};
