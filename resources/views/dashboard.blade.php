<x-app-layout>
    <style>
        .dashboard-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .search-box input {
            border: none;
            outline: none;
            flex-grow: 1;
            font-size: 0.875rem;
            color: #333;
        }

        .user-profile {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5b5bee 0%, #b85dd5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .welcome-box {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .welcome-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .welcome-subtitle {
            font-size: 0.875rem;
            color: #999;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-box {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-box-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #5b5bee;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-box-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
        }

        .section-header {
            font-size: 1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
            margin-top: 0;
        }

        .action-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .action-card {
            border-radius: 16px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            min-height: 200px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .action-card.coral {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
        }

        .action-card.cyan {
            background: linear-gradient(135deg, #00d4ff 0%, #00e4ff 100%);
        }

        .card-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .card-subtitle {
            font-size: 0.75rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .card-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-top: 1rem;
        }

        .card-stats {
            font-size: 0.875rem;
            opacity: 0.95;
        }

        .card-stats strong {
            display: block;
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1;
        }

        .card-arrow {
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .action-card:hover .card-arrow {
            transform: translateX(4px);
        }

        .cta-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .cta-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .cta-content p {
            font-size: 0.875rem;
            color: #999;
        }

        .cta-button {
            background: linear-gradient(135deg, #5b5bee 0%, #b85dd5 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .search-box {
                width: 200px;
            }

            .action-cards-grid {
                grid-template-columns: 1fr;
            }

            .cta-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <!-- Top Bar -->
    <div class="dashboard-top">
        <div class="search-box">
            <span>🔍</span>
            <input type="text" placeholder="Search students...">
        </div>
        <div class="user-profile">{{ substr(auth()->user()->name, 0, 1) }}</div>
    </div>

    <!-- Welcome Box -->
    <div class="welcome-box">
        <h1 class="welcome-title">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="welcome-subtitle">You're doing great this week. Keep it up!</p>
    </div>

    <!-- Statistics -->
    <h2 class="section-header">Statistics</h2>
    <div class="stat-grid">
        <div class="stat-box">
            <div class="stat-box-value">{{ App\Models\Student::count() }}</div>
            <div class="stat-box-label">Total Students</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-value">{{ App\Models\StudentSkill::distinct('student_id')->count() }}</div>
            <div class="stat-box-label">With Skills</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-value">{{ App\Models\StudentActivity::distinct('student_id')->count() }}</div>
            <div class="stat-box-label">With Activities</div>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <h2 class="section-header">Quick Access</h2>
    <div class="action-cards-grid">
        <a href="{{ route('students.index') }}" class="action-card coral">
            <div class="card-icon">👥</div>
            <div class="card-title">Students</div>
            <div class="card-subtitle">Manage student profiles</div>
            <div class="card-footer">
                <div class="card-stats">
                    <strong>{{ App\Models\Student::count() }}</strong>
                    <div>Total</div>
                </div>
                <div class="card-arrow">→</div>
            </div>
        </a>

        <a href="{{ route('queries.index') }}" class="action-card cyan">
            <div class="card-icon">🔍</div>
            <div class="card-title">Search System</div>
            <div class="card-subtitle">Find students easily</div>
            <div class="card-footer">
                <div class="card-stats">
                    <strong>Advanced</strong>
                    <div>Search</div>
                </div>
                <div class="card-arrow">→</div>
            </div>
        </a>
    </div>

    <!-- Call to Action -->
    <div class="cta-card">
        <div class="cta-content">
            <h3>Ready to add a new student?</h3>
            <p>Create a new student profile and start tracking their information.</p>
        </div>
        <a href="{{ route('students.create') }}" class="cta-button">+ Add New Student</a>
    </div>
</x-app-layout>
