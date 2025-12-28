<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MembersImport implements OnEachRow, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows, WithChunkReading
{
    use SkipsFailures;

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $member = Member::where('member_number', $row['member_number'])->first();

        if ($member) {
            $this->updateMember($member, $row);
        } else {
            $this->createMember($row);
        }
    }

    private function updateMember(Member $member, array $row)
    {
        $dataToUpdate = [];
        foreach ($this->getFillableFields() as $field) {
            if (empty($member->{$field}) && !empty($row[$field])) {
                $dataToUpdate[$field] = $row[$field];
            }
        }

        if (!empty($dataToUpdate)) {
            $member->update($dataToUpdate);
        }
    }

    private function createMember(array $row)
    {
        Member::create([
            'name' => $row['name'] ?? null,
            'email' => $row['email'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'date_of_birth' => $row['date_of_birth'] ?? null,
            'doj' => $row['doj'] ?? null,
            'profession' => $row['profession'] ?? null,
            'race' => $row['race'] ?? null,
            'minimum_spent' => $row['minimum_spent'] ?? null,
            'contact_details' => $row['contact_details'] ?? null,
            'status' => $row['status'] ?? null,
            'member_type' => $row['member_type'] ?? null,
            'member_number' => $row['member_number'] ?? 'MEM-' . uniqid(),
        ]);
    }

    private function getFillableFields(): array
    {
        return [
            'name', 'email', 'phone_number', 'date_of_birth', 'doj', 'profession',
            'race', 'minimum_spent', 'contact_details', 'status', 'member_type'
        ];
    }

    public function rules(): array
    {
        return [
            '*.member_number' => 'required|string|max:255',
            '*.name' => 'required|string|max:255',
            '*.email' => 'nullable|email',
            '*.phone_number' => 'nullable|string',
            '*.date_of_birth' => 'nullable|date',
            '*.doj' => 'nullable|date',
            '*.profession' => 'nullable|string',
            '*.race' => 'nullable|string',
            '*.minimum_spent' => 'nullable|numeric',
            '*.contact_details' => 'nullable|string',
            '*.status' => 'nullable|string',
            '*.member_type' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
