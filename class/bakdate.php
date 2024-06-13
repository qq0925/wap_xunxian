    if ($player->tool1!=0){
        $zhuangbei = getzb($player->tool1,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    if ($player->tool2!=0){
        $zhuangbei = getzb($player->tool2,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    if ($player->tool3!=0){
        $zhuangbei = getzb($player->tool3,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    if ($player->tool4!=0){
        $zhuangbei = getzb($player->tool4,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    if ($player->tool5!=0){
        $zhuangbei = getzb($player->tool5,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    if ($player->tool6!=0){
        $zhuangbei = getzb($player->tool6,$dblj);
        $player->ugj = $player->ugj + $zhuangbei->zbgj;
        $player->ufy = $player->ufy + $zhuangbei->zbfy;
        $player->ubj = $player->ubj + $zhuangbei->zbbj;
        $player->uxx = $player->uxx + $zhuangbei->zbxx;
        $player->umaxhp = $player->umaxhp + $zhuangbei->zbhp;
    }
    $rangeslv = array(0, 30, 50, 70, 80, 90, 100, 110);
    $rangesexp = array(2.5, 5, 7.5, 10, 12.5, 15, 17.5);
    $playernextlv = $player->ulv + 1;
    $rangesjj = array('练气', '筑基', '金丹', '元婴', '化神', '炼虚', '合体', '大乘');
    for ($i=0;$i < count($rangeslv);$i++){
        if ($player->ulvl >= $rangeslv[$i] && $player->ulvl < $rangeslv[$i+1]){
            $rangesjd = array('一','二','三','四','五','六','七','八','九','十');
            $djc = $player->ulv - $rangeslv[$i];
            $jds = ($rangeslv[$i+1]-$rangeslv[$i])/10;
            $jieduan = floor($djc/$jds);
            $jd = $rangesjd[$jieduan];
            $player->jingjie = $rangesjj[$i];
            $player->cengci = $jd.'层';
            $player->umaxexp = $playernextlv*($playernextlv+round($playernextlv/2))*12*$rangesexp[$i]+$playernextlv;
            break;
        }

    }
    
        <?php echo "<br/>" ?>
<a href="http://beian.miit.gov.cn/">闽ICP备18005578号</a><br/>