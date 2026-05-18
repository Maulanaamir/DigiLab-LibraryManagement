@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Persetujuan Pengguna</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if($users->isEmpty())
        <div class="p-4 bg-gray-50 rounded">Tidak ada pengguna yang menunggu persetujuan.</div>
    @else
    <div class="bg-white shadow rounded border">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Terdaftar</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ $user->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" onsubmit="return confirm('Approve user ini?');">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
