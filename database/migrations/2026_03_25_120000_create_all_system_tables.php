<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // DEPARTMENTS
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // COURSES
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->text('description')->nullable();
            $table->integer('credits')->default(3);
            $table->foreignId('department_id')->constrained('departments');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // FACULTY
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('faculty_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('office')->nullable();
            $table->string('specialization')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->timestamps();
        });

        // STUDENTS
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('year_level')->default(1);
            $table->enum('status', ['active', 'inactive', 'graduated', 'suspended'])->default('active');
            $table->timestamps();
        });

        // STUDENT ACADEMIC HISTORIES
        Schema::create('student_academic_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('academic_year');
            $table->integer('semester');
            $table->string('grade')->nullable();
            $table->integer('units')->nullable();
            $table->timestamps();
        });

        // STUDENT ACTIVITIES
        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('activity_name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->enum('status', ['active', 'inactive', 'completed'])->default('active');
            $table->timestamps();
        });

        // STUDENT VIOLATIONS
        Schema::create('student_violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('violation_type');
            $table->text('description')->nullable();
            $table->date('date');
            $table->enum('severity', ['minor', 'moderate', 'serious'])->default('moderate');
            $table->enum('status', ['pending', 'resolved', 'dismissed'])->default('pending');
            $table->timestamps();
        });

        // STUDENT SKILLS
        Schema::create('student_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('skill_name');
            $table->enum('proficiency_level', ['beginner', 'intermediate', 'advanced', 'expert'])->default('beginner');
            $table->timestamps();
            $table->unique(['student_id', 'skill_name']);
        });

        // STUDENT AFFILIATIONS
        Schema::create('student_affiliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('affiliation_name');
            $table->enum('affiliation_type', ['organization', 'sport', 'club', 'society'])->default('organization');
            $table->date('date_joined')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // SECTIONS
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('section_name');
            $table->integer('year_level');
            $table->integer('semester');
            $table->integer('capacity')->default(50);
            $table->integer('enrolled_count')->default(0);
            $table->enum('status', ['active', 'inactive', 'full'])->default('active');
            $table->timestamps();
        });

        // ROOMS
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->integer('capacity');
            $table->string('building');
            $table->integer('floor');
            $table->enum('status', ['available', 'maintenance', 'unavailable'])->default('available');
            $table->timestamps();
        });

        // LABORATORIES
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('lab_name')->unique();
            $table->integer('capacity');
            $table->string('building');
            $table->text('equipment')->nullable();
            $table->enum('status', ['available', 'maintenance', 'unavailable'])->default('available');
            $table->timestamps();
        });

        // SCHEDULES
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculty')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('laboratory_id')->nullable()->constrained('laboratories');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->timestamps();
        });

        // SYLLABI
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculty');
            $table->longText('content')->nullable();
            $table->text('objectives')->nullable();
            $table->text('requirements')->nullable();
            $table->timestamps();
        });

        // LESSONS
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('syllabus_id')->constrained('syllabi')->onDelete('cascade');
            $table->integer('lesson_number');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });

        // COURSE_FACULTY
        Schema::create('course_faculty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculty')->onDelete('cascade');
            $table->string('academic_year');
            $table->integer('semester');
            $table->timestamps();
            $table->unique(['course_id', 'faculty_id', 'academic_year', 'semester'], 'course_faculty_unique');
        });

        // CURRICULUM
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments');
            $table->integer('year_level');
            $table->integer('semester');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->unique(['course_id', 'department_id', 'year_level', 'semester'], 'curriculum_unique');
        });

        // EVENTS
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->enum('event_type', ['curricular', 'extracurricular'])->default('curricular');
            $table->text('description')->nullable();
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            $table->string('organizer')->nullable();
            $table->integer('capacity')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('curriculum');
        Schema::dropIfExists('course_faculty');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('syllabi');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('laboratories');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('student_affiliations');
        Schema::dropIfExists('student_skills');
        Schema::dropIfExists('student_violations');
        Schema::dropIfExists('student_activities');
        Schema::dropIfExists('student_academic_histories');
        Schema::dropIfExists('students');
        Schema::dropIfExists('faculty');
        Schema::dropIfExists('departments');
    }
};
