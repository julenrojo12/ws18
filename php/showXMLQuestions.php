<?php
session_start();
$xml =  simplexml_load_file('../xml/questions.xml');
?>
<center><h3> questions.xml fitxategiaren edukia </h3></center>
<br><br>
<table width="70%" border="1px" align="center">
  <thead>
    <tr>
      <th>Eposta</th>
      <th>Galdera</th>
      <th>Erantzun zuzezna</th>
    </tr>
  </thead>
  <tbody>

<?php foreach ($xml->assessmentItem as $assessmentItem) :?>
    <tr>
      <td><?php echo $assessmentItem -> attributes() -> author; ?></td>
      <td><?php echo $assessmentItem-> itemBody -> p; ?></td>
      <td><?php echo $assessmentItem-> correctResponse -> value; ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>

<center><span><a href='layoutLogged.php'>Home</a></span></center>