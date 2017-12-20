function Check()// 验证表单数据有效性的函数
{
    if (document.reg.zh_name.value==""){
        window.alert('请输入用户名!'); 
        return false;
    }
    
    if (document.reg.password.value==""){
        alert('请输入密码!'); 
        return false;
    }
    if (document.reg.password.value.length<6){
        alert('密码长度必须大于6!'); 
        return false;
    }
    if (document.reg.password.value!= document.reg.cpassword.value){
        alert('确认密码与密码不一致!'); 
        return false;
    }
    if (document.reg.email.value==""){
        alert('请输入Email!');
        return false;
    }
    if(document.reg.email.value.indexOf("@")==-1){
        alert('请输入有效的email地址!'); return false;
    }
//       if (document.reg.code.value==""){
//        alert('请输入验证码!');
//        return false;
//    }
//    return true;
//}
