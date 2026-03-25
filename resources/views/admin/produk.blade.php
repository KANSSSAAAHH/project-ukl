<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin PawonLokal</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:sans-serif}

/* ===== LAYOUT ===== */
.wrapper{
  display:flex;
}

/* ===== SIDEBAR ===== */
.sidebar{
  width:220px;
  background:#2c3e50;
  color:#fff;
  min-height:100vh;
  padding:20px;
}
.sidebar h2{
  margin-bottom:20px;
  font-size:18px;
}
.sidebar a{
  display:block;
  color:#ccc;
  padding:10px;
  text-decoration:none;
  border-radius:6px;
  margin-bottom:5px;
}
.sidebar a:hover{
  background:#c0392b;
  color:#fff;
}

/* ===== MAIN ===== */
.main{
  flex:1;
}

/* ===== NAVBAR ===== */
.navbar{
  background:#c0392b;
  color:#fff;
  padding:15px;
  font-weight:bold;
}

/* ===== CONTENT ===== */
.container{
  padding:20px;
}

/* ===== CARD ===== */
.card{
  background:#fff;
  border-radius:10px;
  padding:15px;
  box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

/* ===== TABLE ===== */
table{
  width:100%;
  border-collapse:collapse;
  margin-top:10px;
}
th,td{
  padding:10px;
  border-bottom:1px solid #eee;
  font-size:13px;
}
th{
  background:#f4f4f4;
}

/* ===== BUTTON ===== */
.btn{
  padding:6px 10px;
  border:none;
  border-radius:5px;
  cursor:pointer;
}
.btn-primary{background:#c0392b;color:#fff}
.btn-edit{background:#3498db;color:#fff}
.btn-danger{background:#e74c3c;color:#fff}

/* ===== BADGE ===== */
.badge{
  padding:3px 8px;
  border-radius:10px;
}
.aktif{background:#d4edda;color:#155724}
.nonaktif{background:#f8d7da;color:#721c24}

/* ===== SEARCH ===== */
.search{
  float:right;
  padding:5px;
}
</style>
</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>PawonLokal</h2>
  <a href="/admin/produk">Produk</a>
  <a href="/admin/pengiriman">Pengiriman</a>
  <a href="/admin/pembayaran">Pembayaran</a>
  <a href="/admin/keranjang">Keranjang</a>
  <a href="/admin/review">Review</a>
  <a href="/home">Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  Dashboard Admin
</div>

<div class="container">

<div class="card">

<h3>Manajemen Produk</h3>

<input type="text" class="search" placeholder="Search..." onkeyup="searchData(this.value)">

<button class="btn btn-primary" onclick="openAdd()">+ Tambah</button>

<table>
<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Kategori</th>
<th>Harga</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody id="tbody"></tbody>

</table>

</div>
</div>
</div>
</div>

<script>
const API="/api/admin/produk";
let semuaData=[];
let idEdit=null;

async function load(){
let res=await fetch(API);
semuaData=(await res.json()).data;
render(semuaData);
}

function render(data){
document.getElementById("tbody").innerHTML=
data.map(p=>`
<tr>
<td>${p.id_produk}</td>
<td>${p.nama_produk}</td>
<td>${p.kategori}</td>
<td>${p.harga}</td>
<td><span class="badge ${p.status}">${p.status}</span></td>
<td>
<button class="btn btn-edit" onclick="edit(${p.id_produk})">Edit</button>
<button class="btn btn-danger" onclick="hapus(${p.id_produk})">Delete</button>
</td>
</tr>
`).join("");
}

function searchData(keyword){
let hasil=semuaData.filter(p=>p.nama_produk.toLowerCase().includes(keyword.toLowerCase()));
render(hasil);
}

function openAdd(){
let nama=prompt("Nama Produk:");
let kategori=prompt("Kategori:");
let harga=prompt("Harga:");
let status=prompt("Status (aktif/nonaktif):");

let form=new FormData();
form.append("nama_produk",nama);
form.append("kategori",kategori);
form.append("harga",harga);
form.append("status",status);

fetch(API,{method:"POST",body:form}).then(()=>load());
}

async function edit(id){
let res=await fetch(API+"/"+id);
let p=(await res.json()).data;

let nama=prompt("Edit Nama:",p.nama_produk);
let kategori=prompt("Edit Kategori:",p.kategori);
let harga=prompt("Edit Harga:",p.harga);
let status=prompt("Edit Status:",p.status);

let form=new FormData();
form.append("_method","PUT");
form.append("nama_produk",nama);
form.append("kategori",kategori);
form.append("harga",harga);
form.append("status",status);

fetch(API+"/"+id,{method:"POST",body:form}).then(()=>load());
}

function hapus(id){
if(confirm("Yakin hapus?")){
fetch(API+"/"+id,{method:"DELETE"}).then(()=>load());
}
}

load();
</script>

</body>
</html>