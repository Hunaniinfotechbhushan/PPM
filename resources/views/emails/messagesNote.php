<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mail</title>
</head>
<body>

<div class="mail-box" style="padding:50px; background-color:#F4F7FE; font-size: 14px; line-height: 22px; font-weight: 500; color:black; max-width:650px; width:100%; font-family: system-ui; text-align: center;"> 
    <a href="{{ $urlmain }}" target="_blank"><img src="https://ppmarrangements.com/media-storage/logo/logo.png" width="100px"></a>

    
    <p>Hello <?php echo  $username;?>,</p> 
    <h4>You have new messages</h4> 
    <p> <?php echo  $messagedata;?></p>
     <p> From : <?php echo  $username;?></p>
    <p>Thanks</p>
    <p>The team at ppmarrangements.com</p>
</div>

</body>
</html>