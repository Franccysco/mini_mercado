<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		// $this->verify_login();
		$this->load->model("Participantes_model", "participantes_model");
		$this->load->model("Equipe_model", "equipe_model");
		$this->load->model("Resposta_formulario_model", "respostas_model");
	}

	public function index()
	{
		$dados["title"] = "Home";
		$dados["equipes"] = $this->equipe_model->GetAll('nome');
		$dados["respostas_geral_equipe"] = $this->respostas_model->respostasTotaisPorEquipe("todas") == null ? 0 : $this->respostas_model->respostasTotaisPorEquipe("todas");
		$dados["respostas_geral_equipe_tio"] = $this->respostas_model->respostasTotaisPorEquipeParticipante("todas", "tio") == null ? 0 : $this->respostas_model->respostasTotaisPorEquipeParticipante("todas", "tio");
		$dados["respostas_geral_equipe_primo"] = $this->respostas_model->respostasTotaisPorEquipeParticipante("todas", "primo") == null ?  0 : $dados["respostas_geral_equipe_primo"] = $this->respostas_model->respostasTotaisPorEquipeParticipante("todas", "primo");
		$dados["respostas_recentes"] = ($this->respostas_model->respostasRecentes() == null) ? array() : $this->respostas_model->respostasRecentes();
		// var_dump($dados); die;
		$this->render_page('admin/home', $dados);
	}

	

}


