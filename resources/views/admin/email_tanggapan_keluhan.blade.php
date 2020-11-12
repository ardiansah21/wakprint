<body>
    <h1>Hai {{$laporan->member->nama_lengkap}}</h1>
    <p>Laporan anda {{$laporan->created_at->diffForHumans()}} yang berisi : </p>
    <blockquote style="background-color: #dddddd">{{$laporan->pesan}}</blockquote>
    <p>telah diproses dan ditanggapi dengan pesan : </p>
    <blockquote style="background-color: #dddddd">{{$laporan->pesan_tanggapan}}</blockquote>
    <p>Terima kasih karena telah berkontribusi untuk pelayanan yang lebih baik kedepannya.
        Jika ada yang ingin disampaikan kembali, silahkan bals email ini. Sampai Jumpa</p>
</body>
