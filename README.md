# Project-Web-Tech

<h5>Database defined in config.php using phpMyAdmin</h5>
<p>hostnameorservername = localhost
  <br>
  serverusername = root
  <br>
  serverpassword = 
  <br>
  databasenamed = db_project
</p>

<p>Table: customer
  id_customer [int(11)]<br>
  name [varchar(50)]<br>
  address [varchar(50)]<br>
  area [varchar(50)]<br>
</p>

<p>Table: order
  id_order [int(11)]<br>
  id_customer [int(11)]<br>
  item [varchar(50)]<br>
  price [float]<br>
  qty [smallint(6)]<br>
</p>
