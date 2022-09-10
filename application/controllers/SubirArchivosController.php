<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubirArchivosController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url_helper");
	}

	public function index()
	{
		$this->load->view('multiples-archivos-form.php');
	}

	private function reOrdenarArchivos($archivos)
	{
		$keys = array_keys($archivos);
		$count = count($keys);
		$numero_archivos = count($archivos['name']);
		for ($i = 0; $i < $numero_archivos; $i++) {
			foreach ($keys as $key => $llave) {
				$arrContenido[$llave] = $archivos[$llave][$i];
			}
			$arrFinal[] = $arrContenido;
			$arrContenido = array();
		}
		return $arrFinal;
	}

	public function subirArchivos()
	{
		$this->load->library('upload');
		$archivos = $_FILES['archivos'];
		$archivos_reordenados = $this->reOrdenarArchivos($archivos);
		foreach ($archivos_reordenados as $archivo) {
			// Obtenemos la extension del archivo
			list($nombre_imagen, $extension) = explode('.', $archivo['name']);
			// Generamos un nombre de archivo único con la extension, ej: 56b239862a.jpg
			$nombre_dinamico_archivo = uniqid() . date('YmdHis') . "." . $extension;
			// Esta ruta se ocupará para mover el archivo hacia esta carpeta del servidor
			$ruta_relativa_destino = __DIR__ . '/../../assets/img/' . $nombre_dinamico_archivo;
			// Esta ruta es la ruta absoluta del archivo, ej: http://localhost/mi-proyecto/assets/img/56b239862a.jpg
			$ruta_archivo_final = base_url() . 'assets/img/' . $nombre_dinamico_archivo;
			// Con la función move_uploaded_file de la carpeta temporal al servidor
			move_uploaded_file($archivo['tmp_name'], $ruta_relativa_destino);
			// Imprimimos la ruta final (esta la puedes guardar en una bd) inserta dentro de este foreach tu lógica del modelo
			echo "Ruta final: " . $ruta_archivo_final . "<br>";
		}
	}
}
