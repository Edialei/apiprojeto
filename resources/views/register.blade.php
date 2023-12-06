@extends('master')

@section('content')

    <a href="{{route('home')}}">Home</a>

    <h2>Cadastro</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Campos comuns -->
                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autofocus>
                                    @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required>
                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>
                                <div class="col-md-6">
                                    <input id="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{ old('usuario') }}" required>
                                    @error('usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <!-- Campo para escolher o tipo de usuário -->
                            <div class="form-group row">
                                <label for="tipoUsuario" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>
                                <div class="col-md-6">
                                    <select id="tipoUsuario" name="tipoUsuario" class="form-control @error('tipoUsuario') is-invalid @enderror" required>
                                        <option value="medico">Médico</option>
                                        <option value="paciente">Paciente</option>
                                    </select>
                                    @error('tipoUsuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Campos específicos para médico -->
                            <div id="medicoFields" class="medico-fields" style="display: none;">

                                <div class="form-group row">
                                    <label for="medico_crm" class="col-md-4 col-form-label text-md-right">{{ __('Médico CRM') }}</label>
                                    <div class="col-md-6">
                                        <input id="medico_crm" type="text" class="form-control @error('medico_crm') is-invalid @enderror" name="medico_crm">
                                        @error('medico_crm')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="medicoEspecialidade" class="col-md-4 col-form-label text-md-right">{{ __('Médico Especialidade') }}</label>
                                    <div class="col-md-6">
                                        <select id="medicoEspecialidade" name="medicoEspecialidade" class="form-control @error('medicoEspecialidade') is-invalid @enderror">
                                            <option value="Cardiologia">Cardiologia</option>
                                            <option value="Neurologia">Neurologia</option>
                                            <option value="Endocrinologia">Endocrinologia</option>
                                            <option value="Dermatologia">Dermatologia</option>
                                            <option value="Oftalmologia">Oftalmologia</option>
                                        </select>
                                        @error('medico_especialidade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="medico_bairro" class="col-md-4 col-form-label text-md-right">{{ __('Medico Bairro') }}</label>
                                    <div class="col-md-6">
                                        <input id="medico_bairro" type="text" class="form-control @error('medico_bairro') is-invalid @enderror" name="medico_bairro">
                                        @error('medico_bairro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="medico_cidade" class="col-md-4 col-form-label text-md-right">{{ __('Medico Cidade') }}</label>
                                    <div class="col-md-6">
                                        <input id="medico_cidade" type="text" class="form-control @error('medico_cidade') is-invalid @enderror" name="medico_cidade">
                                        @error('medico_cidade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="medico_logradouro" class="col-md-4 col-form-label text-md-right">{{ __('Medico Logradouro') }}</label>
                                    <div class="col-md-6">
                                        <input id="medico_logradouro" type="text" class="form-control @error('medico_logradouro') is-invalid @enderror" name="medico_logradouro">
                                        @error('medico_logradouro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="medico_preco" class="col-md-4 col-form-label text-md-right">{{ __('Medico preco') }}</label>
                                    <div class="col-md-6">
                                        <input id="medico_preco" type="float" class="form-control @error('medico_preco') is-invalid @enderror" name="medico_preco">
                                        @error('medico_preco')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Campos específicos para paciente -->
                            <div id="pacienteFields" class="paciente-fields" style="display: none;">

                                <div class="form-group row">
                                    <label for="paciente_cpf" class="col-md-4 col-form-label text-md-right">{{ __('Paciente CPF') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_cpf" type="text" class="form-control @error('paciente_cpf') is-invalid @enderror" name="paciente_cpf">
                                        @error('paciente_cpf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_rg" class="col-md-4 col-form-label text-md-right">{{ __('Paciente RG') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_rg" type="text" class="form-control @error('paciente_rg') is-invalid @enderror" name="paciente_rg">
                                        @error('paciente_rg')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_telefone" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Telefone') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_telefone" type="text" class="form-control @error('paciente_telefone') is-invalid @enderror" name="paciente_telefone">
                                        @error('paciente_telefone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_data_nascimento" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Data de Nascimento') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_data_nascimento" type="date" class="form-control @error('paciente_data_nascimento') is-invalid @enderror" name="paciente_data_nascimento">
                                        @error('paciente_data_nascimento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_convenio" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Convênio') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_convenio" type="text" class="form-control @error('paciente_convenio') is-invalid @enderror" name="paciente_convenio">
                                        @error('paciente_convenio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_bairro" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Bairro') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_bairro" type="text" class="form-control @error('paciente_bairro') is-invalid @enderror" name="paciente_bairro">
                                        @error('paciente_bairro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_cidade" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Cidade') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_cidade" type="text" class="form-control @error('paciente_cidade') is-invalid @enderror" name="paciente_cidade">
                                        @error('paciente_cidade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="paciente_logradouro" class="col-md-4 col-form-label text-md-right">{{ __('Paciente Logradouro') }}</label>
                                    <div class="col-md-6">
                                        <input id="paciente_logradouro" type="text" class="form-control @error('paciente_logradouro') is-invalid @enderror" name="paciente_logradouro">
                                        @error('paciente_logradouro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para mostrar/ocultar campos específicos com base no tipo de usuário selecionado
        document.getElementById('tipoUsuario').addEventListener('change', function () {
            var tipoUsuario = this.value;

            if (tipoUsuario === 'medico') {
                document.getElementById('medicoFields').style.display = 'block';
                document.getElementById('pacienteFields').style.display = 'none';
            } else if (tipoUsuario === 'paciente') {
                document.getElementById('medicoFields').style.display = 'none';
                document.getElementById('pacienteFields').style.display = 'block';
            } else {
                document.getElementById('medicoFields').style.display = 'none';
                document.getElementById('pacienteFields').style.display = 'none';
            }
        });
    </script>
@endsection