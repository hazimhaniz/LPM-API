<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
		<link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
		<title>PT3</title>
		<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<style type="text/css">
			body{
			width: 650px;
			font-family: work-Sans, sans-serif;
			background-color: #f6f7fb;
			display: block;
			}
			a{
			text-decoration: none;
			}
			span {
			font-size: 14px;
			}
			p {
			font-size: 13px;
			line-height: 1.7;
			letter-spacing: 0.7px;
			margin-top: 0;
			}
			.text-center{
			text-align: center
			}
			h6 {
			font-size: 16px;
			margin: 0 0 18px 0;
			}
		</style>
	</head>
	<body style="margin: 30px auto;">
		<table style="width: 100%">
			<tbody>
				<tr>
					<td>
						<table style="background-color: #f6f7fb; width: 100%">
							<tbody>
								<tr>
									<td>
										<table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
											<tbody>
												<tr>
													<td><img src="{{asset('assets/images/logo.png')}}" width="200"></td>
													<td style="text-align: right; color:#999"><span>Pendafataran Calon</span></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
							<tbody>
								<tr>
									<td style="padding: 30px">
										<h6 style="font-weight: 600">Pendafataran Berjaya</h6>
										<p>Selamat Datang {{ $details['nama'] }},</p>

										<br>
										
										<p><strong>Status Aktif: </strong> <b style="color: red">Tidak Aktif</b></p>
										<p><strong>Nama Calon: </strong> {{ $details['nama'] }}</p>
										<p><strong>ID Pengguna: </strong> {{ $details['no_kad_pengenalan'] }}</p>

										<br>

										<p>Sila klik butang di bawah untuk sahkan emel:</p>

										<p style="text-align: center">
                                            <a href="{{ route('aktifCalon', ['token' => $details['token']]) }}" style="padding: 10px; background-color: #1aa169; color: #fff; display: inline-block; border-radius: 4px">
                                                Aktif Akaun Disini
                                            </a>
                                        </p>

										<br>

										<p>Terima Kasih</p>
									</td>
								</tr>
							</tbody>
						</table>
						<table style="width: 650px; margin: 0 auto; margin-top: 30px">
							<tbody>
								<tr style="text-align: center">
									<td>
										<p style="color: #999; margin-bottom: 0">© 2021 - Lembaga Peperiksaan Malaysia - LPM</p>
										<p style="color: #999; margin-bottom: 0">Sistem Pentaksiran Tingkatan 3</p>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>