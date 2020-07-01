<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=himatif", "root", "");
	}

	function fetch_all()
	{
		$query = "SELECT * FROM tbl_anggota ORDER BY id";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["nama"]))
		{
			$form_data = array(
				':nama'		=>	$_POST["nama"],
				':nim'		=>	$_POST["nim"],
				':status'		=>	$_POST["status"],
				':divisi'		=>	$_POST["divisi"]
			);
			$query = "
			INSERT INTO tbl_anggota 
			(nama, nim, status, divisi) VALUES 
			(:nama, :nim, :status, :divisi)
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM tbl_anggota WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['nama'] = $row['nama'];
				$data['nim'] = $row['nim'];
				$data['status'] = $row['status'];
				$data['divisi'] = $row['divisi'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["nama"]))
		{
			$form_data = array(
				':nama'	=>	$_POST['nama'],
				':nim'	=>	$_POST['nim'],
				':status'	=>	$_POST['status'],
				':divisi'	=>	$_POST['divisi'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tbl_anggota 
			SET nama = :nama, nim = :nim, status = :status, divisi = :divisi 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM tbl_anggota WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>