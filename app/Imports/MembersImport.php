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

    public function prepareForValidation(array &$row, int $rowIndex): void
    {
        if (isset($row['phone_number'])) {
            $row['phone_number'] = (string) $row['phone_number'];
        }

        if (isset($row['email']) && !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
            $row['email'] = null;
        }
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        Member::create([
            'name'     => $row['name'],
            'email'    => $row['email'] ?? null,
            'phone_number' => $row['phone_number'] ?? null,
            'date_of_birth' => $row['date_of_birth'] ?? null,
            'doj' => $row['doj'] ?? null,
            'profession' => $row['profession'] ?? null,
            'race' => $row['race'] ?? null,
            'minimum_spent' => $row['minimum_spent'] ?? null,
            'contact_details' => $row['contact_details'] ?? null,
            'status' => $row['status'] ?? null,
            'member_type' => $row['member_type'] ?? null,
            'member_number' => 'MEM-' . uniqid(),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:members,email',
            'phone_number' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'doj' => 'nullable|date',
            'profession' => 'nullable|string',
            'race' => 'nullable|string',
            'minimum_spent' => 'nullable|numeric',
            'contact_details' => 'nullable|string',
            'status' => 'nullable|string',
            'member_type' => 'nullable|string',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
