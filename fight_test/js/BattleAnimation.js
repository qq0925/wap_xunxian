// js/BattleAnimation.js
class BattleAnimation {
    constructor() {
        this.battlefield = document.getElementById('battlefield');
        this.battleEnded = false;
        this.turnOrder = []; // 存储行动顺序
        this.animationSpeed = 1; // 默认速度倍率
    }
    
    // 添加设置动画速度的方法
    setAnimationSpeed(speed) {
        this.animationSpeed = speed;
    }

    // 修改等待时间的方法
    async wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms * this.animationSpeed));
    }
    
    // 单体攻击动画
    async singleTargetAttack(attacker, target) {
        // 创建攻击投射物
        const projectile = document.createElement('div');
        projectile.className = 'projectile';
        
        // 获取攻击者和目标的位置
        const attackerElement = document.querySelector(`[data-character="${attacker.name}"]`);
        const targetElement = document.querySelector(`[data-character="${target.name}"]`);
        
        // 设置投射物初始位置（从攻击者位置开始）
        const attackerRect = attackerElement.getBoundingClientRect();
        const targetRect = targetElement.getBoundingClientRect();
        const battleFieldRect = this.battlefield.getBoundingClientRect();
        
        projectile.style.left = (attackerRect.left - battleFieldRect.left + attackerRect.width/2) + 'px';
        projectile.style.top = (attackerRect.top - battleFieldRect.top + attackerRect.height/2) + 'px';
        
        this.battlefield.appendChild(projectile);
        
        // 执行动画
        await this.animate(projectile, {
            left: (targetRect.left - battleFieldRect.left + targetRect.width/2) + 'px',
            top: (targetRect.top - battleFieldRect.top + targetRect.height/2) + 'px'
        }, 500 * this.animationSpeed);
        
        // 显示命中效果
        this.showHitEffect(targetElement);
        
        // 移除投射物
        projectile.remove();
    }
    
    // 显示命中效果
    showHitEffect(targetElement) {
        const effect = document.createElement('div');
        effect.className = 'hit-effect';
        
        const rect = targetElement.getBoundingClientRect();
        const battleFieldRect = this.battlefield.getBoundingClientRect();
        
        effect.style.left = (rect.left - battleFieldRect.left + rect.width/2 - 30) + 'px';
        effect.style.top = (rect.top - battleFieldRect.top + rect.height/2 - 30) + 'px';
        
        this.battlefield.appendChild(effect);
        
        // 动画结束后移除效果
        effect.addEventListener('animationend', () => {
            effect.remove();
        });
        
        // 添加目标抖动效果
        targetElement.classList.add('shake');
        setTimeout(() => {
            targetElement.classList.remove('shake');
        }, 500);
    }
    
    // 动画辅助函数
    animate(element, properties, duration) {
        element.style.transition = `all ${duration}ms ease-in-out`;
        Object.assign(element.style, properties);
        return this.wait(duration);
    }

    createAttackEffect(start, end, attacker) {
        const effect = document.createElement('div');
        effect.className = 'attack-effect';
        effect.setAttribute('data-team', attacker.team);
        effect.style.left = start.x + 'px';
        effect.style.top = start.y + 'px';
        this.battlefield.appendChild(effect);

        // 强制重排以触发动画
        effect.offsetHeight;

        effect.style.left = end.x + 'px';
        effect.style.top = end.y + 'px';

        return new Promise(resolve => {
            setTimeout(() => {
                effect.remove();
                resolve();
            }, 500);
        });
    }

    showDamage(target, damage) {
        const element = document.createElement('div');
        element.className = 'damage-number';
        element.textContent = `-${damage}`;
        
        element.style.left = (target.position.x + 30) + 'px';
        element.style.top = (target.position.y - 20) + 'px';
        
        this.battlefield.appendChild(element);
        
        setTimeout(() => element.remove(), 1000);
    }

    updateStats(character) {
        const charElement = document.querySelector(`[data-character="${character.name}"]`);
        const statsElement = charElement.querySelector('.character-stats');
        
        // 更新HP条
        const hpBar = statsElement.querySelector('.hp-bar > div');
        const hpText = statsElement.querySelector('.hp-text');
        const hpPercent = (character.hp / character.maxHp) * 100;
        hpBar.style.width = `${hpPercent}%`;
        hpText.textContent = `HP: ${character.hp}/${character.maxHp}`;
        
        // 更新MP条
        const mpBar = statsElement.querySelector('.mp-bar > div');
        const mpText = statsElement.querySelector('.mp-text');
        const mpPercent = (character.mp / character.maxMp) * 100;
        mpBar.style.width = `${mpPercent}%`;
        mpText.textContent = `MP: ${character.mp}/${character.maxMp}`;
    }

    showVictoryMessage(winner) {
        const victory = document.createElement('div');
        victory.className = 'victory-text';
        victory.textContent = `${winner.team === 1 ? '我方' : '敌方'}胜利！`;
        this.battlefield.appendChild(victory);
    }

    // 添加显示技能名称的方法
    async showSkillName(attacker) {
        const skillName = document.createElement('div');
        skillName.className = 'skill-name';
        skillName.textContent = attacker.skillName;
        skillName.style.color = attacker.team === 1 ? '#4a90e2' : '#e24a4a';
        
        // 设置位置在角色上方
        skillName.style.left = (attacker.position.x - 20) + 'px';
        skillName.style.top = (attacker.position.y - 40) + 'px';
        
        this.battlefield.appendChild(skillName);
        
        // 修改等待时间
        await this.wait(50);
        skillName.style.opacity = '1';
        skillName.style.transform = 'scale(1)';
        
        await this.wait(1000);
        skillName.style.opacity = '0';
        skillName.style.transform = 'scale(0)';
        
        await this.wait(300);
        skillName.remove();
    }

    // 添加显示技能效果的方法
    async showSkillEffect(attacker, target) {
        const effect = document.createElement('div');
        effect.className = `skill-effect ${attacker.skillEffect}`;
        
        // 设置效果位置
        effect.style.left = (target.position.x - 20) + 'px';
        effect.style.top = (target.position.y - 20) + 'px';
        
        this.battlefield.appendChild(effect);
        
        // 等待动画完成后移除
        await this.wait(800);
        effect.remove();
    }

    async performAttack(attacker, targets) {
        if (this.battleEnded) return;

        // 检查MP是否足够
        if (attacker.mp < attacker.skillMpCost) {
            // MP不足时使用普通攻击
            attacker.skillEffect = 'normal';
            attacker.skillName = '普通攻击';
            attacker.attackRange = 1;
        } else {
            // 消耗MP
            attacker.mp -= attacker.skillMpCost;
            this.updateStats(attacker);
        }

        const attackerElement = document.querySelector(`[data-character="${attacker.name}"]`);
        
        // 显示技能名称
        await this.showSkillName(attacker);
        
        // 根据攻击范围选择目标
        let selectedTargets = [];
        const aliveTargets = targets.filter(target => target.hp > 0);
        
        if (aliveTargets.length === 0) return;
        
        if (attacker.attackRange === -1) {
            // 全体攻击
            selectedTargets = aliveTargets;
        } else {
            // 随机选择指定数量的目标
            const targetCount = Math.min(attacker.attackRange, aliveTargets.length);
            // 随机打乱数组并取前N个
            selectedTargets = aliveTargets
                .sort(() => Math.random() - 0.5)
                .slice(0, targetCount);
        }
        
        // 攻击动画
        attackerElement.classList.add('attacking');
        
        // 同时发射所有投射物和技能效果
        const attackPromises = selectedTargets.map(target => {
            return Promise.all([
                this.singleTargetAttack(attacker, target),
                this.showSkillEffect(attacker, target)
            ]);
        });
        
        await Promise.all(attackPromises.flat());
        
        // 对每个选中的目标执行伤害计算和效果
        for (const target of selectedTargets) {
            const targetElement = document.querySelector(`[data-character="${target.name}"]`);
            
            // 计算伤害（不再降低伤害）
            const damage = Math.floor(Math.random() * 200 + 100);
            
            // 受击动画和伤害显示
            targetElement.classList.add('damaged');
            this.showDamage(target, damage);
            targetElement.classList.add('shake');
            
            // 更新目标HP
            target.hp -= damage;
            this.updateStats(target);
            
            // 检查是否死亡
            if (target.hp <= 0) {
                target.hp = 0;
                this.updateStats(target);
                targetElement.classList.add('dead');
            }
        }
        
        // 等待一段时间后移除所有动画效果
        await this.wait(500);
        
        // 移除所有目标的动画效果
        for (const target of selectedTargets) {
            const targetElement = document.querySelector(`[data-character="${target.name}"]`);
            targetElement.classList.remove('damaged');
            targetElement.classList.remove('shake');
        }
        
        // 检查团队是否全灭
        const teamAlive = targets.some(t => t.hp > 0);
        if (!teamAlive) {
            this.battleEnded = true;
            this.showVictoryMessage(attacker);
            return true;
        }
        
        // 移除攻击者的动画类
        attackerElement.classList.remove('attacking');
        await this.wait(1000);
        return false;
    }

    async startBattle(battleData) {
        // 分组角色
        const team1 = battleData.characters.filter(char => char.team === 1);
        const team2 = battleData.characters.filter(char => char.team === 2);
        
        // 根据速度排序确定行动顺序
        this.turnOrder = [...battleData.characters].sort((a, b) => b.speed - a.speed);
        
        // 战斗循环
        while (!this.battleEnded) {
            for (const character of this.turnOrder) {
                if (character.hp <= 0) continue; // 跳过已死亡角色
                
                // 根据角色队伍选择目标
                const targets = character.team === 1 ? team2 : team1;
                
                if (await this.performAttack(character, targets)) {
                    return; // 战斗结束
                }
                
                await new Promise(resolve => setTimeout(resolve, 1000));
            }
        }
    }

    // 修改角色创建部分
    createCharacterElement(character) {
        const charElement = document.createElement('div');
        charElement.className = 'character';
        charElement.setAttribute('data-character', character.name);
        charElement.setAttribute('data-team', character.team);
        charElement.style.left = character.position.x + 'px';
        charElement.style.top = character.position.y + 'px';
        
        const nameElement = document.createElement('div');
        nameElement.className = 'character-name';
        nameElement.textContent = character.name;
        
        const statsElement = document.createElement('div');
        statsElement.className = 'character-stats';
        
        // 创建HP条
        const hpBar = document.createElement('div');
        hpBar.className = 'hp-bar';
        const hpFill = document.createElement('div');
        hpFill.style.width = '100%';
        hpBar.appendChild(hpFill);
        
        // 创建MP条
        const mpBar = document.createElement('div');
        mpBar.className = 'mp-bar';
        const mpFill = document.createElement('div');
        mpFill.style.width = '100%';
        mpBar.appendChild(mpFill);
        
        // 创建文本显示
        const hpText = document.createElement('div');
        hpText.className = 'stats-text hp-text';
        hpText.textContent = `HP: ${character.hp}/${character.maxHp}`;
        
        const mpText = document.createElement('div');
        mpText.className = 'stats-text mp-text';
        mpText.textContent = `MP: ${character.mp}/${character.maxMp}`;
        
        statsElement.appendChild(hpBar);
        statsElement.appendChild(mpBar);
        statsElement.appendChild(hpText);
        statsElement.appendChild(mpText);
        
        charElement.appendChild(nameElement);
        charElement.appendChild(statsElement);
        
        return charElement;
    }
}