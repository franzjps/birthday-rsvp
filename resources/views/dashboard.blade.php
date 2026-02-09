<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aurie Day | Dashboard</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700|space-grotesk:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif

        <style>
            body {
                background: linear-gradient(135deg, #f8faf6 0%, #e8f0dc 100%);
                min-height: 100vh;
            }

            .dashboard-container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 40px 20px;
            }

            .dashboard-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .dashboard-header h1 {
                font-family: 'Fraunces', serif;
                font-size: 2.5rem;
                color: var(--ink);
                margin: 0 0 8px;
            }

            .dashboard-header p {
                color: var(--subtle-ink);
                font-size: 1rem;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            }

            .stat-card {
                background: white;
                padding: 24px;
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(45, 58, 31, 0.1);
                border: 1px solid rgba(114, 140, 105, 0.15);
                text-align: center;
            }

            .stat-card .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--accent);
                font-family: 'Fraunces', serif;
            }

            .stat-card .stat-label {
                color: var(--subtle-ink);
                font-size: 0.9rem;
                margin-top: 8px;
            }

            .section {
                background: white;
                border-radius: 16px;
                padding: 32px;
                margin-bottom: 32px;
                box-shadow: 0 4px 12px rgba(45, 58, 31, 0.1);
                border: 1px solid rgba(114, 140, 105, 0.15);
            }

            .section h2 {
                font-family: 'Fraunces', serif;
                font-size: 1.5rem;
                color: var(--ink);
                margin: 0 0 24px;
                padding-bottom: 16px;
                border-bottom: 2px solid var(--accent);
            }

            .table-wrapper {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            thead {
                background: var(--panel);
            }

            th {
                padding: 12px 16px;
                text-align: left;
                font-weight: 600;
                color: var(--ink);
                border: 1px solid rgba(114, 140, 105, 0.2);
                font-size: 0.9rem;
            }

            td {
                padding: 14px 16px;
                border: 1px solid rgba(114, 140, 105, 0.15);
                color: var(--ink);
            }

            tbody tr:hover {
                background: var(--panel);
            }

            .contact-badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .contact-phone {
                background: rgba(33, 150, 243, 0.15);
                color: #1976d2;
            }

            .contact-email {
                background: rgba(76, 175, 80, 0.15);
                color: #388e3c;
            }

            .contact-facebook {
                background: rgba(63, 81, 181, 0.15);
                color: #3f51b5;
            }

            .empty-state {
                text-align: center;
                padding: 40px 20px;
                color: var(--subtle-ink);
            }

            .empty-state p {
                margin: 0;
                font-size: 1rem;
            }

            .back-link {
                display: inline-block;
                margin-bottom: 20px;
                color: var(--accent);
                text-decoration: none;
                font-weight: 600;
                font-size: 0.95rem;
            }

            .back-link:hover {
                color: var(--accent-dark);
            }

            @media (max-width: 768px) {
                .dashboard-container {
                    padding: 20px 16px;
                }

                .dashboard-header h1 {
                    font-size: 1.8rem;
                }

                .section {
                    padding: 20px;
                }

                th, td {
                    padding: 10px 12px;
                    font-size: 0.85rem;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="dashboard-container">
            <a href="/" class="back-link">← Back to Home</a>

            <div class="dashboard-header">
                <h1>Aurie Day Dashboard</h1>
                <p>Overview of RSVPs and Love Messages</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalRsvps }}</div>
                    <div class="stat-label">Total RSVPs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalAttending }}</div>
                    <div class="stat-label">Total Guests Attending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $totalLoveMessages }}</div>
                    <div class="stat-label">Love Messages</div>
                </div>
            </div>

            <!-- RSVP Section -->
            <div class="section">
                <h2>RSVP Submissions</h2>
                @if ($rsvps->count() > 0)
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Guest Names</th>
                                    <th>Guest Count</th>
                                    <th>Contact Method</th>
                                    <th>Contact Info</th>
                                    <th>Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rsvps as $rsvp)
                                    <tr>
                                        <td>{{ $rsvp->guest_names }}</td>
                                        <td><strong>{{ $rsvp->guest_count }}</strong></td>
                                        <td>
                                            <span class="contact-badge contact-{{ $rsvp->contact_method }}">
                                                {{ ucfirst($rsvp->contact_method) }}
                                            </span>
                                        </td>
                                        <td>{{ $rsvp->contact_value }}</td>
                                        <td>{{ $rsvp->created_at->format('M d, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <p>No RSVP submissions yet.</p>
                    </div>
                @endif
            </div>

            <!-- Love Messages Section -->
            <div class="section">
                <h2>Love Messages</h2>
                @if ($loveMessages->count() > 0)
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Contact Method</th>
                                    <th>Contact Info</th>
                                    <th>Submitted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loveMessages as $message)
                                    <tr>
                                        <td><strong>{{ $message->name }}</strong></td>
                                        <td>{{ Str::limit($message->message, 50) }}</td>
                                        <td>
                                            <span class="contact-badge contact-{{ $message->contact_method }}">
                                                {{ ucfirst($message->contact_method) }}
                                            </span>
                                        </td>
                                        <td>{{ $message->contact_value }}</td>
                                        <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <p>No love messages yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
