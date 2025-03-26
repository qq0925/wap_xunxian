<?php
/**
 * BCMath 工具函数 - 用于处理超大数的计算
 */

// 设置默认精度
define('BC_SCALE', 0);  // 默认精度为0，即整数

/**
 * 安全地将值转换为适合 BCMath 的字符串格式
 * 
 * @param mixed $value 输入值
 * @return string 格式化后的字符串
 */
function bc_format($value) {
    // 确保输入是字符串
    return (string) $value;
}

/**
 * 安全的加法计算
 * 
 * @param mixed $left 第一个操作数
 * @param mixed $right 第二个操作数
 * @param int|null $scale 结果精度（小数位数）
 * @return string 计算结果
 */
function bc_add($left, $right, $scale = BC_SCALE) {
    return bcadd(bc_format($left), bc_format($right), $scale);
}

/**
 * 安全的减法计算
 * 
 * @param mixed $left 第一个操作数
 * @param mixed $right 第二个操作数
 * @param int|null $scale 结果精度（小数位数）
 * @return string 计算结果
 */
function bc_sub($left, $right, $scale = BC_SCALE) {
    return bcsub(bc_format($left), bc_format($right), $scale);
}

/**
 * 安全的乘法计算
 * 
 * @param mixed $left 第一个操作数
 * @param mixed $right 第二个操作数
 * @param int|null $scale 结果精度（小数位数）
 * @return string 计算结果
 */
function bc_mul($left, $right, $scale = BC_SCALE) {
    return bcmul(bc_format($left), bc_format($right), $scale);
}

/**
 * 安全的除法计算
 * 
 * @param mixed $left 第一个操作数
 * @param mixed $right 第二个操作数
 * @param int|null $scale 结果精度（小数位数）
 * @return string 计算结果，如果除数为0，返回0
 */
function bc_div($left, $right, $scale = BC_SCALE) {
    $right = bc_format($right);
    if (bccomp($right, '0', 10) == 0) {
        return '0'; // 除数为0时返回0
    }
    return bcdiv(bc_format($left), $right, $scale);
}

/**
 * 比较两个数字
 * 
 * @param mixed $left 第一个操作数
 * @param mixed $right 第二个操作数
 * @param int|null $scale 比较精度（小数位数）
 * @return int 如果left > right，返回1；如果left < right，返回-1；如果相等，返回0
 */
function bc_comp($left, $right, $scale = BC_SCALE) {
    return bccomp(bc_format($left), bc_format($right), $scale);
}

/**
 * 取绝对值
 * 
 * @param mixed $value 输入值
 * @return string 绝对值
 */
function bc_abs($value) {
    $value = bc_format($value);
    return (bccomp($value, '0', 10) < 0) ? bc_mul($value, '-1') : $value;
}

/**
 * 计算次方
 * 
 * @param mixed $base 底数
 * @param mixed $exponent 指数（必须是整数）
 * @param int|null $scale 结果精度（小数位数）
 * @return string 结果
 */
function bc_pow($base, $exponent, $scale = BC_SCALE) {
    return bcpow(bc_format($base), bc_format($exponent), $scale);
}

/**
 * 计算平方根
 * 
 * @param mixed $value 输入值（必须非负）
 * @param int|null $scale 结果精度（小数位数）
 * @return string 平方根，如果输入为负数，返回0
 */
function bc_sqrt($value, $scale = BC_SCALE) {
    $value = bc_format($value);
    if (bccomp($value, '0', 10) < 0) {
        return '0'; // 负数返回0
    }
    return bcsqrt($value, $scale);
}

/**
 * 计算模（余数）
 * 
 * @param mixed $dividend 被除数
 * @param mixed $divisor 除数
 * @param int|null $scale 结果精度（小数位数）
 * @return string 余数，如果除数为0，返回被除数
 */
function bc_mod($dividend, $divisor, $scale = BC_SCALE) {
    $divisor = bc_format($divisor);
    if (bccomp($divisor, '0', 10) == 0) {
        return bc_format($dividend); // 除数为0时返回被除数
    }
    return bcmod(bc_format($dividend), $divisor, $scale);
}

/**
 * 转换数字为格式化字符串（如添加千位分隔符等）
 * 
 * @param mixed $value 输入值
 * @param bool $add_commas 是否添加千位分隔符
 * @return string 格式化后的字符串
 */
function bc_format_number($value, $add_commas = false) {
    $value = bc_format($value);
    
    // 分离整数部分和小数部分
    $parts = explode('.', $value);
    $int_part = $parts[0];
    $dec_part = isset($parts[1]) ? $parts[1] : '';
    
    // 如果需要添加千位分隔符
    if ($add_commas) {
        $int_part = number_format(bc_abs($int_part));
        // 保留符号
        if (bccomp($value, '0', 10) < 0) {
            $int_part = '-' . $int_part;
        }
    }
    
    // 重新组合整数和小数部分
    return $dec_part ? $int_part . '.' . $dec_part : $int_part;
} 