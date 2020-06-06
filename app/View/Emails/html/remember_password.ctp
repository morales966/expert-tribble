<!DOCTYPE html>
<html lang="es">
<head>
	<title>Restablecer contraseña</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
</head>
<body style="background-color:#f8f8f8;">
	<table align="center" style="width: 600px; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;background-color:#ffffff;">
		<tr>
			<td>
				<table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
					<tr align="center">
						<td style="width:50px;"></td>
						<td style="width:500px;">
							<br>
							<h1>
								<b style="color:#031730; text-transform: capitalize;">
									CREDIVENTAS
								</b>
							</h2>
						</td>
						<td style="width:50px;"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
					<tr align="center">
						<td style="width:50px;"></td>
						<td style="width:500px;">
							<h2><b style="color:#031730; text-transform: capitalize;">
								Hola <?php echo $name; ?>
							</b></h2>
							<p style="color:#6f6f6f;">Has solicitado restablecer tu contraseña para ingresar a CREDIVENTAS.com</p>
						</td>
						<td style="width:50px;"></td>
					</tr>
				</table>
				<br>
				<table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
					<tr align="center">
						<td style="width:600px;">
							<p style="color: #031730;">
								Por favor haz clic en el siguiente enlace y continúa el proceso de restablecimiento: <br>
								<a href="<?php echo Router::url('/', true).'users/remember_password_step_2/'.$hash ?>">
									<b>Restablecer la contraseña</b>
								</a>
							</p>
						</td>
					</tr>  
				</table>
				<br>
				<table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
					<tr align="center">
						<td style="width:50px;"></td>
						<td style="width:500px;">

							<p style="color:#6f6f6f;">Si no fuiste tu o no necesitas realizar este procedimiento por favor ignora este mensaje y accede normalmente a tu cuenta.</p>
						</td>
						<td style="width:50px;"></td>
					</tr>
				</table>
				<br>
				<table border="0" align="center" cellpadding="0" cellspacing="0" class="mbtn20 mtop10" cellmargin="0">
					<tr>
						<td width="225"></td>
						<td width="150" height="30" bgcolor="#031730" align="center"> <a href="<?php echo Router::url('/', true)?>pages/home" style="color:#ffffff; text-decoration:none;">
							<span style="font-family:arial; font-size:14px;color:#ffffff;">IR A CREDIVENTAS.COM</span></a>
						</td>
						<td width="225"></td>

					</tr>
				</table>
				<br>
				<table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
					<tr align="center">
						<td style="width:50px;"></td>
						<td style="width:500px;">
							<hr>
							<p style="color:#6f6f6f;"><span> Crediventas.com </span></p><br>
						</td>
						<td style="width:50px;"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>