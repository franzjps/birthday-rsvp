<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard Login | Aurie Day</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700|space-grotesk:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <style>
            body {
                background: linear-gradient(135deg, #f8faf6 0%, #e8f0dc 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Space Grotesk', sans-serif;
            }

            .login-container {
                width: 100%;
                max-width: 400px;
                padding: 20px;
            }

            .login-card {
                background: white;
                border-radius: 24px;
                padding: 40px;
                box-shadow: 0 24px 60px rgba(45, 58, 31, 0.2);
                border: 1px solid rgba(114, 140, 105, 0.2);
            }

            .login-header {
                text-align: center;
                margin-bottom: 32px;
            }

            .login-header h1 {
                font-family: 'Fraunces', serif;
                font-size: 1.8rem;
                color: var(--ink);
                margin: 0 0 8px;
                font-weight: 600;
            }

            .login-header p {
                color: var(--subtle-ink);
                font-size: 0.95rem;
                margin: 0;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-weight: 600;
                font-size: 0.95rem;
                color: var(--ink);
                margin-bottom: 8px;
            }

            .form-input {
                width: 100%;
                border-radius: 12px;
                border: 1px solid rgba(114, 140, 105, 0.3);
                padding: 12px 14px;
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.95rem;
                color: var(--ink);
                background: #f9fbf6;
                box-sizing: border-box;
                transition: border 0.2s ease, box-shadow 0.2s ease;
            }

            .form-input:focus {
                outline: none;
                border-color: var(--accent);
                box-shadow: 0 0 0 3px var(--ring);
            }

            .form-error {
                color: #f44336;
                font-size: 0.85rem;
                margin-top: 6px;
            }

            .submit-btn {
                width: 100%;
                padding: 12px;
                background: var(--accent);
                color: white;
                border: none;
                border-radius: 12px;
                font-family: 'Space Grotesk', sans-serif;
                font-weight: 600;
                font-size: 0.95rem;
                cursor: pointer;
                transition: all 0.2s ease;
                margin-top: 24px;
            }

            .submit-btn:hover {
                background: #5a945a;
                box-shadow: 0 4px 12px rgba(91, 133, 91, 0.3);
            }

            .submit-btn:active {
                transform: translateY(1px);
            }

            .back-link {
                display: block;
                text-align: center;
                margin-top: 20px;
                color: var(--accent);
                text-decoration: none;
                font-size: 0.95rem;
                transition: color 0.2s ease;
            }

            .back-link:hover {
                color: #5a945a;
            }

            .error-message {
                background: #ffebee;
                border: 1px solid #f44336;
                color: #c62828;
                padding: 12px 14px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h1>Dashboard Login</h1>
                    <p>Aurie's Event Management</p>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first('username') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.authenticate') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">Username or Email</label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            class="form-input"
                            value="{{ old('username') }}"
                            required
                            autofocus
                            placeholder="Enter your username or email"
                        />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input"
                            required
                            placeholder="Enter your password"
                        />
                    </div>

                    <button type="submit" class="submit-btn">Sign In</button>
                </form>

                <a href="/" class="back-link">← Back to Home</a>
            </div>
        </div>
    </body>
</html>
