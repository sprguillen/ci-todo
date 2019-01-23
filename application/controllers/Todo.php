<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('task_model');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index() {
		$this->render_view('index');
	}

	public function add_task() {
		$name = $_POST['name'];
		$has_task = $this->task_model->count_by_task_name($name);
		if ($has_task) {
			$data = array('status' => false, 'message' => 'Task already exists.');
			echo json_encode($data);
		} else {
			$result = $this->task_model->insert($name);
			if ($result) {
				$data = array('status' => true);
				echo json_encode($data);
			} else {
				$data = array('status' => false, 'message' => 'Error on adding new task.');
				echo json_encode($data);
			}
		} 
	}

	public function edit_task() {
		$id = $_POST['id'];
		$name = $_POST['name'];

		$has_task = $this->task_model->count_by_task_name($name);
		if ($has_task) {
			$data = array('status' => false, 'message' => 'Task already exists.');
			echo json_encode($data);
		} else {
			$result = $this->task_model->edit_name($id, $name);
			if ($result) {
				$data = array('status' => true);
				echo json_encode($data);
			} else {
				$data = array('status' => false, 'message' => 'Error on editing task ' . $id);
				echo json_encode($data);
			}
		}
	}

	public function get_tasks() {
		echo json_encode($this->task_model->get_all_tasks());
	}

	public function delete_task() {
		$id = $_POST['id'];
		$result = $this->task_model->delete_task($id);
		if ($result) {
			$data = array('status' => true);
			echo json_encode($data);
		} else {
			$data = array('status' => false, 'message' => 'Error on deleting task ' . $id);
			echo json_encode($data);
		}
	}

	private function render_view($template_name = null) {
		$full_path = 'todo/' . $template_name;
		$this->load->view('header');
		$this->load->view($full_path);
		$this->load->view('footer');
	}
}
