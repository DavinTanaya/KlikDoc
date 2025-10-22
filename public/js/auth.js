document.addEventListener("DOMContentLoaded", function () {
    const loginTab = document.getElementById("login-tab");
    const signupTab = document.getElementById("signup-tab");
    const loginForm = document.getElementById("login-form");
    const signupForm = document.getElementById("signup-form");

    function switchForm(showForm, hideForm, activeTab, inactiveTab) {
        showForm.classList.remove("hidden");
        hideForm.classList.add("hidden");
        activeTab.classList.add("tab-active");
        activeTab.classList.remove("text-gray-600");
        inactiveTab.classList.remove("tab-active");
        inactiveTab.classList.add("text-gray-600");
    }

    loginTab.addEventListener("click", function () {
        switchForm(loginForm, signupForm, loginTab, signupTab);
    });

    signupTab.addEventListener("click", function () {
        switchForm(signupForm, loginForm, signupTab, loginTab);
    });

    function setupPasswordToggle(
        passwordInputId,
        toggleButtonId,
        eyeIconId,
        eyeOffIconId
    ) {
        const passwordInput = document.getElementById(passwordInputId);
        const toggleButton = document.getElementById(toggleButtonId);
        const eyeIcon = document.getElementById(eyeIconId);
        const eyeOffIcon = document.getElementById(eyeOffIconId);

        toggleButton.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);

            eyeIcon.classList.toggle("hidden");
            eyeOffIcon.classList.toggle("hidden");
        });
    }

    setupPasswordToggle(
        "login-password",
        "toggle-login-password",
        "eye-icon-login",
        "eye-off-icon-login"
    );
    setupPasswordToggle(
        "signup-password",
        "toggle-signup-password",
        "eye-icon-signup",
        "eye-off-icon-signup"
    );
});
