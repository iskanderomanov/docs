@php use App\Http\Enums\RateTypes;use App\Utils\RouteNames; @endphp
@extends('layouts.master')
@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills ">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{route(RouteNames::USER_INDEX)}}">
                            Назад
                        </a>
                    </li>
                </ul>
                <h3 class="card-title">Создание пользователя</h3>
            </div>
            <div class="col-lg-12 mb-3">
                <form
                    action="{{ isset($user) ? route(RouteNames::USER_UPDATE,$user->id) : route(RouteNames::USER_STORE) }}"
                    method="post" class="ajax">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">ФИО *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name ?? ''}}"
                                   placeholder="Пример: Тонуева Гульнара Иманбековна">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3">
                            <label class="form-label">Логин *</label>
                            <input type="text" class="form-control" name="email" id="email"
                                   value="{{$user->email ?? ''}}" placeholder="Пример: tonueva@gmail.com">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Пароль *</label>
                            <input type="password" class="form-control" name="password" id="password" value=""
                                   placeholder="Пример: 12345678">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3">
                            <label class="form-label">Профессия *</label>
                            <select type="text" class="form-select" id="user_type" name="user_type" tabindex="-1">
                                @foreach(\App\Http\Enums\UserTypes::cases() as $userType)
                                    <option value="{{ $userType->value }}"
                                            @if(isset($user) && $user->user_type == $userType->value) selected @endif>
                                        {{ \App\Http\Enums\UserTypes::getUserTypeText($userType->value) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3">
                            <label class="form-label">Должность</label>
                            <select type="text" class="form-select" id="position_id" name="position_id" tabindex="-1">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}"
                                            @if(isset($user) && $user->position_id == $position->id) selected @endif>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3">
                            <label class="form-label">Факультет</label>
                            <select type="text" class="form-select" id="department_id" name="department_id"
                                    tabindex="-1">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                            @if(isset($user) && $user->department_id == $department->id) selected @endif>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3 teacher_blocks" id="checkboxDiv" style="display: none;">
                            <div class="divide-y">
                                <div>
                                    <label class="row">
                                        <span class="col">Табельщик</span>
                                        <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       @if(isset($user) && $user->is_time_keeper)
                                                           checked
                                                       @endif
                                                       name="is_time_keeper">
                                            </label>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3 teacher_blocks" id="checkboxDiv2" style="display: none;">
                            <div class="divide-y">
                                <div>
                                    <label class="row">
                                        <span class="col">Штатный соотрудник</span>
                                        <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" id="is_in_state" type="checkbox"
                                                       @if(isset($user) && $user->is_in_state)
                                                           checked
                                                       @endif
                                                       name="is_in_state">
                                            </label>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3 teacher_blocks not_state" style="display: none;">
                            <label class="form-label">Штатная ставка *</label>
                            <input type="number" step="0.05" class="form-control"
                                   name="rate[{{ RateTypes::MAIN->value }}]" id="rate[{{ RateTypes::MAIN->value }}]"
                                   value="{{
    isset($user) ?
    $user->rates->where('rate_type', RateTypes::getRateId(RateTypes::MAIN->value))->first('value')->rate ?? ''
    : ''
                                    }}" placeholder="Пример: 1.0" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="invalid-feedback " id="error"></div>
                        <div class="mb-3 teacher_blocks not_state" style="display: none;">
                            <label class="form-label">Дополнительная ставка </label>
                            <input type="number" step="0.05" class="form-control"
                                   name="rate[{{ RateTypes::ADDITIONAL->value }}]"
                                   id="rate[{{ RateTypes::ADDITIONAL->value }}]"
                                   value="{{
    isset($user) ?
    $user->rates->where('rate_type', RateTypes::getRateId(RateTypes::ADDITIONAL->value))->first('value')->rate ?? ''
    : ''
                                    }}" placeholder="Пример: 0.25">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="invalid-feedback" id="error"></div>
                        <div class="mb-3 teacher_blocks in_state" style="display: none;">
                            <label class="form-label">Наемная ставка *</label>
                            <input type="number" step="0.05" class="form-control"
                                   name="rate[{{ RateTypes::HIRED->value }}]" id="rate[{{ RateTypes::HIRED }}]"
                                   value="{{
    isset($user) ?
    $user->rates->where('rate_type', RateTypes::getRateId(RateTypes::HIRED->value))->first('value')->rate ?? ''
    : ''
                                    }}" placeholder="Пример: 0.75" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="invalid-feedback" id="error"></div>
                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content here -->
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const professionSelect = document.getElementById('user_type');
            const teacherDivs = document.querySelectorAll('.teacher_blocks');
            const checkbox = document.getElementById('is_in_state');
            const inStateDiv = document.querySelector('.in_state');
            const notStateDivs = document.querySelectorAll('.not_state');

            // начальные действия
            const selectedOption = professionSelect.options[professionSelect.selectedIndex].text;
            console.log(selectedOption)
            if (selectedOption === 'Преподаватель') {
                const isChecked = checkbox.checked;
                toggleTeacherDivs(selectedOption === 'Преподаватель');
                toggleStateDivs(isChecked);
            }

            professionSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex].text;
                const isChecked = checkbox.checked;
                toggleTeacherDivs(selectedOption === 'Преподаватель');

                if (selectedOption === 'Преподаватель') toggleStateDivs(isChecked);
            });

            checkbox.addEventListener('change', function () {
                const isChecked = checkbox.checked;
                toggleStateDivs(isChecked);
            });

            function toggleTeacherDivs(show) {
                teacherDivs.forEach(function (div) {
                    div.style.display = show ? 'block' : 'none';
                    const inputs = div.querySelectorAll('input');
                    inputs.forEach(function (input) {
                        input.disabled = !show;
                    });
                });
            }

            function toggleStateDivs(isChecked) {
                inStateDiv.style.display = isChecked ? 'none' : 'block';
                const inputsInState = inStateDiv.querySelectorAll('input');
                inputsInState.forEach(function (input) {
                    input.disabled = isChecked;
                });

                notStateDivs.forEach(function (div) {
                    div.style.display = isChecked ? 'block' : 'none';
                    const inputs = div.querySelectorAll('input');
                    inputs.forEach(function (input) {
                        input.disabled = !isChecked;
                    });
                });
            }
        });


    </script>
@endpush
