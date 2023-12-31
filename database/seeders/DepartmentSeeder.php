<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $jenisDept = ['Commercial','Direksi','Finance & Administration','Operation ISP & Telco','Operation Digital Solution','Retail','HC & Legal'];
        $aliasDept = ['CMR','DIR','FIN','TO','SDV','RET','HC'];

        $cmr = ['Manager Commercial','Account Manager','Admin Project','IMERS'];
        $dir = ['Direktur Utama','Direktur','Assistant Direksi','Project Manager Government'];
        $fin = ['Manager Finance & Administration','Finance & Tax','Account & Tax','Cost Control','Procurement','GA & Logistic','Office Boy & Runner'];
        $to = ['Manager Operation ISP & Telco','Network Engineer','Network Operation Center','Helpdesk','Technician','Technician Representative'];
        $sdv = ['Manager Digital Solution','System Analyst','UI/UX Designer','Software Engineer','IOT Engineer','Digital Solution Representative'];
        $ret = ['Direct Sales','Leader Area','Admin Support','Technician FTTH','Office Boy & Runner',' GA & Logistic'];
        $hc = ['HSE & QC','Legal & Admin','Human Capital'];

        for ($i=0; $i < count($jenisDept); $i++) {
            Department::create([
                'department_name' => $jenisDept[$i],
                'department_alias' => $aliasDept[$i],
                'parent_id' => $i == 0? null : $i,
            ]);
        }

        for ($k=0; $k < count($dir); $k++) {
            $divDir = Division::create([
                'department_id'=>2,
                'divisi_name'=>$dir[$k],
                'parent_id' => $k + 1,
                'parent_id' => $k == 0? null : $k,
            ]);
        }

        for ($j=0; $j < count($cmr); $j++) {
            $divCmr = Division::create([
                'department_id'=>1,
                'divisi_name'=>$cmr[$j],
                'parent_id' => $j+1,
            ]);
        }


        for ($l=0; $l < count($fin); $l++) {
            $divFin = Division::create([
                'department_id'=>3,
                'divisi_name'=>$fin[$l],
                'parent_id' => $l + 1,
            ]);
        }

        for ($m=0; $m < count($to); $m++) {
            $divTo = Division::create([
                'department_id'=>4,
                'divisi_name'=>$to[$m],
                'parent_id' => $m + 1,
            ]);
        }

        for ($n=0; $n < count($sdv); $n++) {
            $divSdv = Division::create([
                'department_id'=>5,
                'divisi_name'=>$sdv[$n],
                'parent_id' => $n + 1,
            ]);
        }

        for ($o=0; $o < count($ret); $o++) {
            $divRet = Division::create([
                'department_id'=>6,
                'divisi_name'=>$ret[$o],
                'parent_id' => $o + 1,
            ]);
        }

        for ($p=0; $p < count($hc); $p++) {
            $divHc = Division::create([
                'department_id'=>7,
                'divisi_name'=>$hc[$p],
                'parent_id' => $p + 1,
            ]);
        }

    }
}
