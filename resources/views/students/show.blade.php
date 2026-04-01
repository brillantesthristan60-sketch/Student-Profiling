<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Student Profile: ') . $student->full_name }}
            </h2>
            <div>
                <a href="{{ route('students.edit', $student) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit Student
                </a>
                <a href="{{ route('students.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Basic Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <strong>Student ID:</strong> {{ $student->student_id }}
                        </div>
                        <div>
                            <strong>Full Name:</strong> {{ $student->full_name }}
                        </div>
                        <div>
                            <strong>Year Level:</strong> {{ $student->year_level }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $student->email }}
                        </div>
                        <div>
                            <strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}
                        </div>
                        <div>
                            <strong>Status:</strong>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($student->status === 'active') bg-green-100 text-green-800
                                @elseif($student->status === 'inactive') bg-yellow-100 text-yellow-800
                                @elseif($student->status === 'graduated') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($student->status) }}
                            </span>
                        </div>
                        @if($student->date_of_birth)
                        <div>
                            <strong>Date of Birth:</strong> {{ $student->date_of_birth->format('M d, Y') }}
                        </div>
                        @endif
                        @if($student->gender)
                        <div>
                            <strong>Gender:</strong> {{ ucfirst($student->gender) }}
                        </div>
                        @endif
                        @if($student->address)
                        <div class="col-span-2">
                            <strong>Address:</strong> {{ $student->address }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Academic History -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Academic History</h3>
                    @if($student->academicHistories->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Course</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Academic Year</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Semester</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Grade</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Units</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($student->academicHistories as $history)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $history->course->course_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $history->academic_year }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $history->semester }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $history->grade ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $history->units ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No academic history found.</p>
                    @endif
                </div>
            </div>

            <!-- Activities -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Activities</h3>
                    @if($student->activities->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($student->activities as $activity)
                            <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                <h4 class="font-medium">{{ $activity->activity_name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $activity->description }}</p>
                                <p class="text-sm mt-2"><strong>Date:</strong> {{ $activity->date->format('M d, Y') }}</p>
                                <p class="text-sm"><strong>Status:</strong> {{ ucfirst($activity->status) }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No activities found.</p>
                    @endif
                </div>
            </div>

            <!-- Skills -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Skills</h3>
                    @if($student->skills->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($student->skills as $skill)
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm">
                                {{ $skill->skill_name }} ({{ ucfirst($skill->proficiency_level) }})
                            </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No skills found.</p>
                    @endif
                </div>
            </div>

            <!-- Affiliations -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Affiliations</h3>
                    @if($student->affiliations->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($student->affiliations as $affiliation)
                            <div class="border border-gray-200 dark:border-gray-700 rounded p-4">
                                <h4 class="font-medium">{{ $affiliation->affiliation_name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($affiliation->affiliation_type) }}</p>
                                @if($affiliation->date_joined)
                                <p class="text-sm mt-2"><strong>Joined:</strong> {{ $affiliation->date_joined->format('M d, Y') }}</p>
                                @endif
                                <p class="text-sm"><strong>Status:</strong> {{ ucfirst($affiliation->status) }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No affiliations found.</p>
                    @endif
                </div>
            </div>

            <!-- Violations -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Violations</h3>
                    @if($student->violations->count() > 0)
                        <div class="space-y-4">
                            @foreach($student->violations as $violation)
                            <div class="border border-red-200 dark:border-red-700 rounded p-4">
                                <h4 class="font-medium text-red-600 dark:text-red-400">{{ $violation->violation_type }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $violation->description }}</p>
                                <p class="text-sm mt-2"><strong>Date:</strong> {{ $violation->date->format('M d, Y') }}</p>
                                <p class="text-sm"><strong>Severity:</strong> {{ ucfirst($violation->severity) }}</p>
                                <p class="text-sm"><strong>Status:</strong> {{ ucfirst($violation->status) }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No violations found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>