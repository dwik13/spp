<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Account_model extends CI_Model
{
	// Stored Procedure untuk mengefisienkan pembuatan code program pada suatu bahasa pemrograman ketika akan membuat program CRUD(Create, Read, Update, Delete) menggunakan database MySQL. sebuah fungsi berisi kode SQL yang dapat digunakan kembali
    public function login_check($username, $password)
    {
        $query = $this->db->query("call login_check('" . $username . "','" . $password . "')"); //call login_check adalah mengecek login petugas dan admin/ memanggil stored procedure pada database yang bernama login_check. login check berisi menampilkan tb_petugas dimana parameter user = username dan parameter pass = password
        mysqli_next_result($this->db->conn_id); // di mana properti koneksinya disebut conn_id.
        return $query->num_rows();
    }

	//mengambil login username dan password
    public function login_get($username, $password)
    {
        $query = $this->db->query("call login_check('" . $username . "','" . $password . "')");
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }

	//menampilkan tb_level dimana parameter level= id_level
    public function level_get($id_level)
    {
        $query = $this->db->query("call level_get('" . $id_level . "')");
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }

	//mengecek login siswa
    public function siswa_check($username, $password)
    {
        $query = $this->db->query("call siswa_check('" . $username . "', '" . $password . "')"); //siswa check berisi menampilkan tb_siswa dimana parameter user = nisn dan parameter pass = nik
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }

	//function login check dan siswa check untuk multitable/multiuser yaitu login dengan 2 tabel yang berbeda dan user yang berbeda pula

	//mengambil login username(nisn) dan password(nik)
    public function siswa_get($username, $password)
    {
        $query = $this->db->query("call siswa_check('" . $username . "', '" . $password . "')");
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }
}