<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;

}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<table>

  <?php foreach ($dailymenu as $key => $v): ?>
  	<tr>
  		<td><?= $v['slug']; ?></td>
  		<td><?= $v['session']; ?></td>
  		<td>
  		<ol>
<?php foreach ($v['picked_menu'] as $k => $name): ?>
  				<li><?= $name['menu_chinese']; ?></li>
  			<?php endforeach ?>
  			
  		</ol>
  			
  		</td>
  	</tr>
  	
  <?php endforeach ?>
</table>