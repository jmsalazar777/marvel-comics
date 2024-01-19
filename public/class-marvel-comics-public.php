<?php
class Marvel_Comics_Public
{
	private $marvel_comics_data;
	private $marvel_api_key = 'fa50ceece7d47d87437737882131cb19';
	private $marvel_hash = '47f8bca6d96c9cf39dc0a15e9d0faf3d7e92ca53';

	public function __construct($marvel_comics, $version)
	{
		$this->marvel_comics = $marvel_comics;
		$this->version = $version;

		add_shortcode('marvel_comics', array($this, 'marvel_comics_shortcode'));
		add_shortcode('marvel_heroes', array($this, 'marvel_heroes_shortcode'));
	}

	public function enqueue_styles()
	{
		wp_enqueue_style($this->marvel_comics, plugin_dir_url(__FILE__) . 'css/styles.css', array(), $this->version, 'all');
		wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	}

	public function enqueue_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '', true);
		wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('popper'), '', true);
		wp_enqueue_script($this->marvel_comics, plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery'), $this->version, true);
	}

	public function marvel_comics_shortcode($atts)
	{
		$this->fetch_marvel_comics();

		ob_start();
		include(plugin_dir_path(__FILE__) . '/partials/marvel-comics-public-display.php');
		$content = ob_get_clean();

		return $content;
	}

	public function marvel_heroes_shortcode($atts)
	{
		$name = '';
		$name_starts_with = '';
		$modified_since = '';
		$comics = '';
		$series = '';
		$events = '';
		$stories = '';

		$characters_data = $this->fetch_marvel_characters($name, $name_starts_with, $modified_since, $comics, $series, $events, $stories);

		ob_start();
		include(plugin_dir_path(__FILE__) . '/partials/marvel-heroes-public-display.php');
		$content = ob_get_clean();

		return $content;
	}

	public function fetch_marvel_comics()
	{
		$api_url = 'https://gateway.marvel.com/v1/public/comics';
		$api_params = array(
			'apikey' => $this->marvel_api_key,
			'hash' => md5(time() . $this->marvel_hash . $this->marvel_api_key),
			'ts' => time(),
			'titleStartsWith' => 'Spider-Man',
			'limit' => 8,
		);
		$response = wp_remote_get(add_query_arg($api_params, $api_url));

		if (is_wp_error($response)) {
			return 'Error fetching marvel comics';
		}

		$body = wp_remote_retrieve_body($response);
		$data = json_decode($body, true);
		$this->marvel_comics_data = $data;
		return $data;
	}

	public function fetch_marvel_characters($name = '', $name_starts_with = '', $modified_since = '', $comics = '', $series = '', $events = '', $stories = '')
	{
		$api_url = 'https://gateway.marvel.com/v1/public/characters';

		$api_params = array(
			'apikey' => $this->marvel_api_key,
			'hash' => md5(time() . $this->marvel_hash . $this->marvel_api_key),
			'ts' => time(),
			'limit' => 8,
		);

		if (!empty($name)) {
			$api_params['name'] = $name;
		}

		if (!empty($name_starts_with)) {
			$api_params['nameStartsWith'] = $name_starts_with;
		}

		if (!empty($modified_since)) {
			$api_params['modifiedSince'] = $modified_since;
		}

		if (!empty($comics)) {
			$api_params['comics'] = $comics;
		}

		if (!empty($series)) {
			$api_params['series'] = $series;
		}

		if (!empty($events)) {
			$api_params['events'] = $events;
		}

		if (!empty($stories)) {
			$api_params['stories'] = $stories;
		}

		$response = wp_remote_get(add_query_arg($api_params, $api_url));

		if (is_wp_error($response)) {
			return 'Error fetching Marvel characters';
		}

		$body = wp_remote_retrieve_body($response);
		$data = json_decode($body, true);
		$characters_data = $data['data']['results'];

		return $characters_data;
	}
}
