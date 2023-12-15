<?php

namespace App\Http\Controllers;

use App\Models\Assignment\Assignment;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class ValidateLetterController extends Controller
{
    public function assignment(string $assignment, string $userId)
    {
        try {
            $assignmentId = decrypt($assignment);
            $userId = decrypt($userId);

            $assignment = Assignment::whereId($assignmentId)->first();

            if (!$assignment) {
                throw new \Exception('Assignment not found');
            }

            $userAssignment = $assignment->userAssignments()->whereId($userId)->first();

            if (!$userAssignment) {
                throw new \Exception('User assignment not found');
            }

            return view('letter-validation.assignment.valid', compact([
                'assignment', 'userAssignment'
            ]));
        } catch (\Exception $e) {
            return view('letter-validation.assignment.not-valid');
        }
    }
}
