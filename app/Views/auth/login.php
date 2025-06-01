
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Arsip Surat Bawaslu</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="/assets/deskapp/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="/assets/deskapp/vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="/assets/deskapp/vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/assets/deskapp/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/assets/deskapp/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="/assets/deskapp/vendors/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/deskapp/vendors/styles/css.css" />
		    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
   		 	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	</head>
	<body class="login-page">
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="/images/logo-bawaslu.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-danger">Login</h2>
							</div>
							<form id="form-login">
								<div class="input-group custom">
									<input
										type="email"
										class="form-control form-control-lg"
										placeholder="email"
										name="email"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>
								<div class="input-group custom">
									<input
										type="password"
										class="form-control form-control-lg"
										placeholder="**********"
										name="password"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<button
												class="btn btn-primary btn-lg btn-block"
												type="submit"
												>Sign In</button
											>
										</div>
										<div
											class="font-16 weight-600 pt-10 pb-10 text-center"
											data-color="#707373"
										>
											OR
										</div>
										<div class="input-group mb-0">
											<a
												class="btn btn-outline-primary btn-lg btn-block"
												href="<?= base_url('/auth/register') ?>"
												>Register To Create Account</a
											>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>

    $(function(){

        function login() {
            const form = $('#form-login').on('submit', function (e) {   
                e.preventDefault();
                const form = $(this)
                const formData = {
                    email: form.find('input[name="email"]').val(),
                    password: form.find('input[name="password"]').val()
                }
                console.log(formData)
                $.ajax({
                    url: '/api/v1/auth/login',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response){
                        const message = response.message
                        const role = response.role;
						const id = response.id;
						const name = response.name;

						localStorage.setItem('id', id);
						localStorage.setItem('name', name);
                        
                        if(role == 'admin'){
						
                            window.location.href = '/admin/dashboard'
                        } else {
                            window.location.href = '/user/dashboard'
                        }

                        alert(response.message)
                    },  
                    error: function(xhr, error, status){
                        try{
                                const response = JSON.parse(xhr.responseText);
                                    let errorMessage = '';
                                    if (response.messages) {
                                        for (const key in response.messages) {
                                            if (response.messages.hasOwnProperty(key)) {
                                                errorMessage += `${response.messages[key]}\n`;
                                            }
                                        }
                                    } else if (response.message) {
                                        errorMessage = response.message;
                                    } else {
                                        errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                                    }
                                    alert(errorMessage);
                            }catch(e){
                                console.error('Gagal parse response error:', e);
                                alert('Terjadi kesalahan saat memproses respons error.');
                            }
                    }
                })
            })
        }


        login()

        function logout() {
            $('#logout').on('click', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/auth/logout',
                    type: 'POST',
                    success: function(response) {
                        const message = response.message;
                        alert(message);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            let errorMessage = '';
                            if (response.messages) {
                                for (const key in response.messages) {
                                    if (response.messages.hasOwnProperty(key)) {
                                        errorMessage += `${response.messages[key]}\n`;
                                    }
                                }
                            } else if (response.message) {
                                errorMessage = response.message;
                            } else {
                                errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                            }
                            alert(errorMessage);
                        } catch (e) {
                            console.error('Gagal parse response error:', e);
                            alert('Terjadi kesalahan saat memproses respons error.');
                        }
                    }
                });
            });
        }

        logout(); 

    })

</script>

		<!-- js -->
		<script src="/assets/deskapp/vendors/scripts/core.js"></script>
		<script src="/assets/deskapp/vendors/scripts/script.min.js"></script>
		<script src="/assets/deskapp/vendors/scripts/process.js"></script>
		<script src="/assets/deskapp/vendors/scripts/layout-settings.js"></script>
	</body>
</html>
