document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | VALIDACIÓN GENERAL
    |--------------------------------------------------------------------------
    */

    const forms = document.querySelectorAll('.needs-validation');

    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });


    /*
    |--------------------------------------------------------------------------
    | REGISTRO DE USUARIO
    |--------------------------------------------------------------------------
    */

    const registerForm = document.getElementById('registerForm');

    if (registerForm) {

        const name = document.getElementById('name');
        const password = document.getElementById('password');
        const passwordConfirmation =
            document.getElementById('password_confirmation');

        const nameRegex =
            /^[A-Za-zÁÉÍÓÚáéíóúÑñÜü\s'-]+$/;

        if (name) {
            name.addEventListener('input', () => {

                const value = name.value.trim();

                if (value.length < 2) {
                    name.setCustomValidity(
                        'El nombre debe tener mínimo 2 caracteres.'
                    );
                } else if (!nameRegex.test(value)) {
                    name.setCustomValidity(
                        'El nombre solo puede contener letras y espacios.'
                    );
                } else {
                    name.setCustomValidity('');
                }
            });
        }


        function validatePassword() {

            if (!password || !passwordConfirmation) {
                return;
            }

            const value = password.value;

            const strongPassword =
                /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

            if (!strongPassword.test(value)) {
                password.setCustomValidity(
                    'La contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula y un número.'
                );
            } else {
                password.setCustomValidity('');
            }

            if (
                passwordConfirmation.value &&
                passwordConfirmation.value !== value
            ) {
                passwordConfirmation.setCustomValidity(
                    'Las contraseñas no coinciden.'
                );
            } else {
                passwordConfirmation.setCustomValidity('');
            }
        }

        password?.addEventListener('input', validatePassword);

        passwordConfirmation?.addEventListener(
            'input',
            validatePassword
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULARIOS DE TAREAS
    |--------------------------------------------------------------------------
    */

    const taskForm = document.getElementById('taskForm');

    if (taskForm) {

        const title = document.getElementById('title');
        const description = document.getElementById('description');
        const dueDate = document.getElementById('due_date');


        if (title) {
            title.addEventListener('input', () => {

                const value = title.value.trim();

                if (value.length < 3) {
                    title.setCustomValidity(
                        'El título debe tener mínimo 3 caracteres.'
                    );
                } else if (value.length > 150) {
                    title.setCustomValidity(
                        'El título no puede superar los 150 caracteres.'
                    );
                } else {
                    title.setCustomValidity('');
                }
            });
        }


        if (description) {
            description.addEventListener('input', () => {

                if (description.value.length > 1000) {
                    description.setCustomValidity(
                        'La descripción no puede superar los 1000 caracteres.'
                    );
                } else {
                    description.setCustomValidity('');
                }
            });
        }


        if (dueDate) {

            const today =
                new Date().toISOString().split('T')[0];

            dueDate.min = today;

            dueDate.addEventListener('change', () => {

                if (
                    dueDate.value &&
                    dueDate.value < today
                ) {
                    dueDate.setCustomValidity(
                        'La fecha límite no puede ser anterior a hoy.'
                    );
                } else {
                    dueDate.setCustomValidity('');
                }
            });
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRMAR ELIMINACIÓN
    |--------------------------------------------------------------------------
    */

    const deleteForms =
        document.querySelectorAll('.delete-task-form');

    deleteForms.forEach((form) => {

        form.addEventListener('submit', (event) => {

            const confirmation = confirm(
                '¿Seguro que deseas eliminar esta tarea?'
            );

            if (!confirmation) {
                event.preventDefault();
            }
        });
    });

});