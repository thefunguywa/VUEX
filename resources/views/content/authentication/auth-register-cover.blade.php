@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">
      <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
        <defs>
          <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
            <stop stop-color="#000000" offset="0%"></stop>
            <stop stop-color="#FFFFFF" offset="100%"></stop>
          </lineargradient>
          <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
            <stop stop-color="#FFFFFF" offset="100%"></stop>
          </lineargradient>
        </defs>
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Artboard" transform="translate(-400.000000, -178.000000)">
            <g id="Group" transform="translate(400.000000, 178.000000)">
              <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
              <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
              <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
              <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
              <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
            </g>
          </g>
        </g>
      </svg>
      <h2 class="brand-text text-primary ms-1">Vuexy</h2>
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Register-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Adventure starts here 🚀</h2>
        <p class="card-text mb-2">Make your app management easy and fun!</p>
        <form id="registerForm" class="auth-register-form mt-2">
          @csrf
          <div class="mb-1">
            <label class="form-label" for="name">Username</label>
            <input class="form-control" id="name" type="text" name="name" placeholder="johndoe" aria-describedby="name" autofocus tabindex="1" />
            <div class="invalid-feedback" id="name-error"></div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="2" />
            <div class="invalid-feedback" id="email-error"></div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="3" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            <div class="invalid-feedback" id="password-error"></div>
          </div>
          <div class="mb-1">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password_confirmation" type="password" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" tabindex="4" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="terms" name="terms" type="checkbox" tabindex="5" required />
              <label class="form-check-label" for="terms">I agree to<a href="#">&nbsp;privacy policy & terms</a></label>
              <div class="invalid-feedback">You must agree to the terms and conditions</div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100" tabindex="6" id="register-btn">Sign up</button>
        </form>
        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{url('auth/login-cover')}}"><span>&nbsp;Sign in instead</span></a>
        </p>
      
      </div>
    </div>
    <!-- /Register-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endsection

@section('page-script')
<script>
$(document).ready(function() {
    // Verifica se o SweetAlert2 está carregado
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 não está carregado');
    }

    // CSRF Token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Form submission handler
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        // Reset validation
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        // Validação básica do front-end
        if (!$('#terms').is(':checked')) {
            $('#terms').addClass('is-invalid');
            Swal.fire({
                title: 'Terms Required',
                text: 'You must agree to the terms and conditions',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Verifica se as senhas coincidem
        if ($('#password').val() !== $('#password_confirmation').val()) {
            $('#password, #password_confirmation').addClass('is-invalid');
            $('#password-error').text('Passwords do not match');
            Swal.fire({
                title: 'Password Mismatch',
                text: 'The passwords you entered do not match',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Mostra loading no botão
        const registerBtn = $('#register-btn');
        registerBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Signing up...');

        // Cria FormData para enviar os dados (melhor para debugging)
        const formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        formData.append('password_confirmation', $('#password_confirmation').val());
        formData.append('terms', $('#terms').is(':checked') ? '1' : '0');

        // Debug: Mostra os dados que serão enviados
        console.log('Dados sendo enviados:', {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
            terms: $('#terms').is(':checked')
        });

        // AJAX request
        $.ajax({
            url: "{{ route('register') }}",
            type: "POST",
            data: formData,
            processData: false, // Necessário para FormData
            contentType: false, // Necessário para FormData
            dataType: "json",
            success: function(response) {
                console.log('Resposta do servidor:', response);

                if(response.token && response.user) {
                    // Store token
                    localStorage.setItem('authToken', response.token);

                    // Mostra mensagem de sucesso
                    Swal.fire({
                        title: 'Success!',
                        text: 'Registration completed successfully!',
                        icon: 'success',
                        confirmButtonText: 'Continue',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            // Redirect to dashboard
                            window.location.href = response.redirect || '/dashboard';
                        }
                    });
                } else {
                    // Caso não receba token mas a requisição foi bem sucedida
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Registration completed successfully! Please login.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                }
            },
            error: function(xhr) {
                console.error('Erro na requisição:', xhr);
                // Reativa o botão
                registerBtn.prop('disabled', false).html('Sign up');

                // Trata erros de validação
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for(let field in errors) {
                        $(`#${field}`).addClass('is-invalid');
                        $(`#${field}-error`).text(errors[field][0]);
                    }

                    // Mostra o primeiro erro com SweetAlert
                    const firstError = Object.values(errors)[0][0];
                    Swal.fire({
                        title: 'Validation Error',
                        text: firstError,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Outros erros
                    const errorMsg = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'An error occurred during registration. Please try again.';

                    Swal.fire({
                        title: 'Error!',
                        text: errorMsg,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    // Initialize Feather Icons
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }
});
</script>
@endsection
