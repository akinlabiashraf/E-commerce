<?php
$ref = $_GET["reference"];

if ($ref === "") {
    header("location:javascript://history.go(-1)");
    exit;
}
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer pk_test_bcd49d44b985824c11b25d67a4a6ac64dcc451e0",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $result = json_decode($response);

  }
  if($result->data->status == 'success'){
    $status = $result->data->status;
    $reference = $result->data->reference;
    $last_name = $result->data->customer->last_name;
    $first_name = $result->data->customer->first_name;
    $full_name = $last_name . ' '. $first_name;
    $customer_email = $result->data->customer->email;
    date_default_timezone_set('Africa/Lagos');
    $date_time = date('m/d/y h:i:s a', true);

    include('config.php');
    $stat = $db_con->prepare("INSERT INTO customers_details (status, reference, full_name, date_purchased, email) VALUES (?, ?, ?, ?, ?)");
    $stat->bind_param("sssss", $status, $reference, $full_name, $date_time, $customer_email); 
    $stat->execute();
    if ($stat->error) {
        echo "Problem Occurred: " . $stat->error;
    } else {
        header("location: Success.php?status=success");
        exit;
    }
    $stat->close();
    $db_con->close();
} else {
    header("location:error.php");
    exit;
}
?>
