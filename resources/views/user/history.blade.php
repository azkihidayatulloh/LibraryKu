@extends('user.sidebar')

@section('sidebar-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">History Peminjaman</div>
                <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id Pinjam</th>
                                <th class="text-center">Judul Buku</th>
                                <th class="text-center">Status Verifikasi</th>
                                <th class="text-center">Tanggal Pinjam</th>
                                <th class="text-center">Tanggal Kembali</th>
                                <th class="text-center">Denda</th>
                                <th class="text-center">Status Kembali</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $item)
                            <tr>
                                <td>{{ $item->transactionId }}</td>
                                <td>{{ $item->buku->bookTitle }}</td>
                                <td>
                                    @if($item->isVerified)
                                    <button class="btn btn-success">
                                        Terverifikasi
                                    </button>
                                    @else
                                    <button class="btn btn-danger">
                                        Belum Terverifikasi
                                    </button>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td>{{ $item->denda }}</td>
                                <td>
                                @if($item->isReturned)
                                    <button class="btn btn-success">
                                        Sudah Dikembalikan
                                    </button>
                                    @else
                                    <button class="btn btn-danger">
                                        Belum Dikembalikan
                                    </button>
                                    @endif
                                </td>
                                <td>
                                    @if((!$item->isReturned) && $item->isVerified)
                                    <form action="{{ route('user.transaction.return', ['id' => $item->transactionId]) }}" method="post">
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <input type="submit" class="btn btn-primary" value="Kembalikan">
                                        @csrf
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
