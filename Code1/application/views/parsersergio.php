<body>
	<div id="container1">
		<h3>{h3_string}</h3>
		<div>
			<p>{p_string}</p>
			<table>
    			<thead>
    				<tr>
    					<th>ID</th>
    					<th>NOME</th>
    					<th>EMAIL</th>
    				</tr>
    			</thead>
				<tbody>
					{list_clients}
					<tr>
						<td>{id}</td>
						<td>{nome}</td>
						<td>{email}</td>
					</tr>
					{/list_clients}
				</tbody>
			</table>
		</div>
    </div>
	
	
	<!-- Exemplo 2 -->
	<div id="container">
    	<h3>{list_users_h}</h3>
    	<div>
		<table>
    			<thead>
    				<tr>
    					<th>ID</th>
    					<th>NOME</th>
    					<th>EMAIL</th>
						<th>FULLNAME</th>
    				</tr>
    			</thead>
    			<tbody>
    				{list_users}
    				<tr> 
    					<td>{id}</td>
    					<td>{username}</td>
    					<td>{morada}</td>
						<td>{fullname}</td>
    				</tr>
    				{/list_users}
    			</tbody>
    		</table>
	<p>{p_string}</p>
    	</div>
    </div>
</body>	
	
		