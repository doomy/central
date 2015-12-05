<?php

namespace DateParser;

use Template;
use Environment;
use DateParser;

class Sampler {
    private $samples;

    public function render() {
        $template = new Template(
            'DateParser/sampler.tpl.php',
            array(
                'dates' => $this->get_sampler_data()
            )
        );
        return $template->process_output();
    }

    public function set_samples($samples) {
        $this->samples = $samples;
    }

    private function get_sampler_data() {
        $samples = $this->get_samples();
        $i = 0;
        foreach ($samples as $sample) {
            $parse_result = DateParser::parse_date($sample);
            $sampler[$i]['original'] = $parse_result->original;
            $sampler[$i]['parsed'] = $parse_result->parsed;
            $sampler[$i]['certainty'] = $parse_result->certainty->get_string_representation();
            $i++;
        }
        return $sampler;
    }

    private function get_samples() {
        if ($this->samples) return $this->samples;

        $env =  Environment::get_env();
        $path = $env->CONFIG['CENTRAL_PATH'].'data/DateParser/sampler.txt';
        $contents = file_get_contents($path);
        $this->samples = explode("\n", $contents);
        return $this->samples;
    }
}

?> 