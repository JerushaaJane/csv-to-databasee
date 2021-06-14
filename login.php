<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CSV Importation</title>
</head>
<body style="color:white;background-color:#AB0E6B">
  <center>
    <br />
    <br />
    <br />
    <br />
    <h2>Welcome to CSV file importation application !!</h2>
    <img src="https://www.efilecabinet.com/wp-content/uploads/2019/03/csv-01.png" alt="csv file image" width="100" height="100" style="border:5px solid white">
    <form class=""  action="database.php" method="post" enctype="multipart/form-data">
      <label><h3><b>Choose CSVFile</b></h3></label><br>
      <input type="file" name="file" id="file" accept=".csv"><br />
      <marquee>Click "Import" and get your files stored in database"</marquee>
      <input type="submit" name="import" value="Import">

    </form>

  </center>
</body>
</html>
