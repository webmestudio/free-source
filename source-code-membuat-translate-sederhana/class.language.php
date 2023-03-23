<?php 

// hiddent bug error
error_reporting(0);

// starting class
class Language 
{
	/**
	 * Bahasa default 
	 */
	private $default = 'ID';

	/*
	 * lokasi file
	 */
	private $langpath = 'bahasa/';

	/**
	 * fungsi auto detect bahasa yang terdapat browser
	 * dan default bahasa di browser adalah english
	 * alternative
	 * @return bool
	 */
	private function _detect() 
	{
		// bahasa default di browser (en)
		$lang_in_browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

		// jika bahasa di browser == data di property
		if ($lang_in_browser == $this->default) // true
		{
			// mengembalikan nilai
			$this->language = strtoupper($lang_in_browser);
		}
		else // false
		{
			$this->language = strtoupper($this->default);
		}
	}

	/**
	 * fungsi pengecekan file
	 * @param  $language = value bisa { ID, EN, DLL }
	 * @return bool
	 */
	private function _check($language = null) 
	{
		$filename = $this->langpath . strtoupper($language) . "_lang.php";

		// jika file tersedia
		if(file_exists($filename)) 
		{
			return true;
		}
		else // false
		{
			return false;
		}
	} 

	/**
	 * fungsi set bahasa ke browser dan data sebegai data yang di simpan sementara
	 * @param  $language = value bisa { ID, EN, DLL }
	 * @return bool
	 */
	private function _set($language = null) 
	{
		// sesi memulai
		session_start();

		if($language)
		{
			// buat sesi bahasa
			$_SESSION['language'] = $language;
		}

		// cek jika sesi belum ada 
		if(!$_SESSION['language'])
		{
			$_SESSION['language'] = $this->default;
		}

		// cek data bahasa jika sudah di buat sesi
		// pernyataannya
		// jika nama file tersedia dengan mangacu param $_SESSION['language'] adalah nama filenya maka
        if($this->_check($_SESSION['language'])) 
        {
        	// mengembalikan nilai nya
        	return $_SESSION['language'];
        }
        else 
        {
        	// mengembalikan ke default bahasa
        	return $this->default;
        }
	} 

	/*
	 * otentikasi untuk membaca file dan mendapatkanya
	 * contoh pemakaian :
	 * $lang = new Language($_POST['lang']);
	 * $lang['key dalam array'];
	 */
	public function get($language = null) 
	{
		$language = $this->_set($language);
		require $this->langpath . $language. "_lang.php";
		return $language = $lang;
	}

}

?>