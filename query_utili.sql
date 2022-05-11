# Prelevare solo gli appartamenti disponibili:
select * from appartamenti where IdAppartamento not in (
	Select distinct idAppartamento from affitti
);