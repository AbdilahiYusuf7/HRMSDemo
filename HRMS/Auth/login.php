<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>System Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

        :root {
            --brand-primary: #cde9f8;
            --brand-hover: #cde9f8;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            min-height: 100dvh;
            padding: 0.5rem;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            max-height: calc(100dvh - 1rem);
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: transform 0.3s ease;
        }

        .logo-circle {
            width: 56px;
            height: 56px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--brand-primary);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .btn-login {
            background-color: var(--brand-primary);
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--brand-hover);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .role-toggle-container {
            position: relative;
            display: flex;
            width: 100%;
            margin-bottom: 1rem;
            padding: 4px;
            background: #f1f5f9;
            border-radius: 12px;
        }

        .role-option {
            z-index: 1;
            flex: 1;
            padding: 8px 0;
            color: #64748b;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .role-option.active {
            color: #1e293b;
        }

        .role-slider {
            position: absolute;
            top: 4px;
            left: 4px;
            width: calc(50% - 4px);
            height: calc(100% - 8px);
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .role-toggle-container.admin-selected .role-slider {
            transform: translateX(100%);
        }

        .custom-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--brand-primary);
        }

        @media (max-width: 400px) {
            .login-card {
                padding: 1rem;
                border-radius: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card rounded-3xl flex flex-col items-center">
        <div class="logo-circle rounded-full text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 mb-3 tracking-tight">HRM System</h1>

        <div class="role-toggle-container" id="roleToggle">
            <div class="role-slider"></div>
            <div class="role-option active" data-role="employee">Employee</div>
            <div class="role-option" data-role="admin">Admin</div>
            <input type="hidden" id="selectedRole" value="employee">
        </div>

        <form id="loginForm" class="w-full space-y-3">
            <div class="input-group">
                <label for="username" class="block text-sm font-medium text-gray-600 mb-1.5 ml-1">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 transition-all duration-200"
                    placeholder="Enter your username">
            </div>

            <div class="input-group">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5 ml-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 transition-all duration-200"
                    placeholder="********">
            </div>

            <div class="flex items-center justify-between text-sm px-1">
                <label class="flex items-center space-x-2 cursor-pointer group">
                    <input type="checkbox" class="custom-checkbox rounded border-gray-300">
                    <span class="text-gray-500 group-hover:text-gray-700 transition-colors">Remember me</span>
                </label>
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login w-full py-2.5 rounded-xl text-white font-semibold text-lg shadow-lg mt-1">
                Sign In
            </button>
        </form>

        <div id="messageBox" class="mt-3 text-sm hidden p-3 rounded-lg w-full text-center"></div>

    </div>

    <script>
        const roleToggle = document.getElementById('roleToggle');
        const roleOptions = roleToggle.querySelectorAll('.role-option');
        const roleInput = document.getElementById('selectedRole');

        roleOptions.forEach(option => {
            option.addEventListener('click', () => {
                const role = option.getAttribute('data-role');

                roleOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');

                if (role === 'admin') {
                    roleToggle.classList.add('admin-selected');
                } else {
                    roleToggle.classList.remove('admin-selected');
                }

                roleInput.value = role;
            });
        });

        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const messageBox = document.getElementById('messageBox');
            const username = document.getElementById('username').value;
            const role = roleInput.value;
            const btn = e.target.querySelector('button');
            const originalText = btn.innerText;

            btn.innerText = 'Verifying...';
            btn.disabled = true;
            btn.style.opacity = '0.7';

            setTimeout(() => {
                messageBox.classList.remove('hidden', 'bg-red-50', 'text-red-600', 'bg-green-50', 'text-green-600');

                if (username.length < 3) {
                    messageBox.innerText = 'Invalid username or password.';
                    messageBox.classList.add('bg-red-50', 'text-red-600');
                } else {
                    messageBox.innerText = `Welcome back ${role}, ${username}! Redirecting...`;

                    messageBox.classList.add('bg-green-50', 'text-green-600');
                }

                messageBox.classList.remove('hidden');
                btn.innerText = originalText;
                btn.disabled = false;
                btn.style.opacity = '1';

                if (username.length >= 3) {
                    setTimeout(() => {
                        window.location.href = role === 'admin' ? '../pages/dashboard.php' : '../EmployeePortal/pages/dashboard.php';
                    }, 600);
                }
            }, 1200);
        });
    </script>
</body>
</html>
