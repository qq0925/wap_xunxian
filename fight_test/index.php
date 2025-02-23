<?php
// index.php
require_once 'classes/Character.php';
require_once 'classes/BattleSystem.php';

// 初始化战斗系统
$battle = new BattleSystem();

// 修改角色初始化，添加MP和技能消耗
$characters = [
    // 我方角色（team 1）
    new Character("青云子", 100, 1000, ["x" => 100, "y" => 100], 1, 15, -1, "天罡气旋", "wind", 200, 50),
    new Character("剑心", 90, 800, ["x" => 100, "y" => 200], 1, 20, 1, "破空斩", "sword", 150, 30),
    new Character("灵儿", 80, 600, ["x" => 100, "y" => 300], 1, 18, 2, "双龙术", "dragon", 180, 40),
    
    // 敌方角色（team 2）
    new Character("烈焰魔狼", 95, 900, ["x" => 600, "y" => 100], 2, 17, 2, "炎爪", "fire", 160, 35),
    new Character("暗影刺客", 85, 700, ["x" => 600, "y" => 200], 2, 19, 1, "暗影突刺", "shadow", 140, 25),
    new Character("巨岩守卫", 110, 1200, ["x" => 600, "y" => 300], 2, 12, -1, "大地震击", "earth", 180, 45)
];

// 将角色添加到战斗系统
foreach ($characters as $character) {
    $battle->addCharacter($character);
}

// 获取战斗顺序
$turnOrder = $battle->determineTurnOrder();

// 准备前端所需的数据
$battleData = [
    'turnOrder' => $turnOrder,
    'characters' => $battle->getCharacters()
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>回合制战斗系统</title>
    <link rel="stylesheet" href="css/battle.css">
</head>
<body>
    <!-- 添加速度控制器 -->
    <div class="speed-control">
        <label for="animation-speed">动画速度：</label>
        <input type="range" id="animation-speed" min="0.5" max="2" step="0.1" value="1">
        <span id="speed-value">1x</span>
    </div>
    
    <div id="battlefield" class="battlefield">
        <!-- 角色将通过JavaScript动态添加 -->
    </div>
    
    <script src="js/BattleAnimation.js"></script>
    <script>
    // 将PHP数据传递给JavaScript
    const battleData = <?php echo json_encode($battleData); ?>;
    
    document.addEventListener('DOMContentLoaded', function() {
        const battlefield = document.getElementById('battlefield');
        const battleAnimation = new BattleAnimation();
        
        // 添加速度控制逻辑
        const speedControl = document.getElementById('animation-speed');
        const speedValue = document.getElementById('speed-value');
        
        speedControl.addEventListener('input', function() {
            const speed = this.value;
            speedValue.textContent = speed + 'x';
            battleAnimation.setAnimationSpeed(1 / speed);
        });

        // 使用新的createCharacterElement方法创建角色
        battleData.characters.forEach(character => {
            const charElement = battleAnimation.createCharacterElement(character);
            battlefield.appendChild(charElement);
        });

        // 倒计时开始
        let countdown = 3;
        const countdownElement = document.createElement('div');
        countdownElement.style.cssText = `
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            font-weight: bold;
            color: #333;
            z-index: 1000;
        `;
        battlefield.appendChild(countdownElement);

        const countdownInterval = setInterval(() => {
            if (countdown > 0) {
                countdownElement.textContent = countdown;
                countdown--;
            } else {
                clearInterval(countdownInterval);
                countdownElement.remove();
                battleAnimation.startBattle(battleData);
            }
        }, 1000);
    });
    </script>
</body>
</html>