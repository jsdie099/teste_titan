
function cleanTable(){
    var linhas = document.getElementById('produtos_tabela').rows;
    for (i=linhas.length-1; i>0; i--){
        document.getElementById('produtos_tabela').deleteRow(i);
    }
}

//busca todos os registros da tabela Produto e lista na tabela
async function list(){
    await axios.get("http://localhost:8080/Avaliacao-PHP-MYSQL/functions").then((res)=>{
        // Acessa a tabela:
        var produtos_tabela = document.getElementById('produtos_tabela');
        //insere os valores na tabela
        
        res.data.forEach(element => {            
            let preco = element.preco;
            row = produtos_tabela.insertRow(1);
            row.innerHTML = '<td id="'+element.idprod+'">'+element.nome+'</td><td>'+element.cor+'</td><td>R$'+element.preco+'</td>';
        });
    }).catch(e=>console.log(e));
}
list();

//filtra todos os registros da tabela Produto e lista na tabela
document.getElementById("filter").onclick = async function(e){
    let nome = document.getElementById("filtro_produto").value;
    let precos = document.getElementById("filtro_preco").value;
    let cores = document.getElementById("cores_filtro");
    let value = cores.options[cores.selectedIndex].value;
    if(nome !== "" || precos !== "" || value !== ""){
        await axios.get("http://localhost:8080/Avaliacao-PHP-MYSQL/functions/filters.php", {params:{
            nome,
            precos,
            cores: value
        }}).then((res)=>{
            cleanTable();
            // Acessa a tabela:
            var produtos_tabela = document.getElementById('produtos_tabela');
            //insere os valores na tabela
            res.data.forEach(element => {            
                row = produtos_tabela.insertRow(1);
                row.innerHTML = '<td id="'+element.idprod+'" >'+element.nome+'</td><td>'+element.cor+'</td><td>R$'+element.preco.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});+'</td>';
            });
        }).catch(e=>console.log(e));
    }
}
document.getElementById("clean_filter").onclick = async function(){
    document.getElementById("filtro_produto").value = "";
    document.getElementById("filtro_preco").value = "";
    let cores = document.getElementById("cores_filtro");
    cores.selectedIndex = 0;   
}
//insere os dados na tabela produto e precos
document.getElementById("insert").onclick = async function(){
    let nome = document.getElementById("nome").value;
    let precos = document.getElementById("precos").value;
    let cores = document.getElementById("cores");
    let value = cores.options[cores.selectedIndex].value;
    if(nome !== "" && precos !== "" && value !== ""){
        axios.post("http://localhost:8080/Avaliacao-PHP-MYSQL/functions/insert.php", {nome, cores: value, precos}).then((res)=>{
            cleanTable();
            list();
        }).catch(e=>console.log(e));
    }
}

//atualiza os dados na tabela produto e precos
document.getElementById("update").onclick = async function(){
    let nome = document.getElementById("nome").value;
    let precos = document.getElementById("precos").value;
    let id = produtos_tabela.getElementsByTagName("td")[0].id;
    if(nome !== "" && precos !== ""){
        await axios.post("http://localhost:8080/Avaliacao-PHP-MYSQL/functions/update.php", {idprod:id, nome, precos}).then((res)=>{
            cleanTable();
            list();
        }).catch(e=>console.log(e));
    }
}

//apaga os dados na tabela produto e precos
document.getElementById("delete").onclick = async function(){
    var produtos_tabela = document.getElementById('produtos_tabela');
    let id = produtos_tabela.getElementsByTagName("td")[0].id;
    produtos_tabela.deleteRow(1);
    axios.delete("http://localhost:8080/Avaliacao-PHP-MYSQL/functions/delete.php", {params:{
        idprod:id
    }}).then((res)=>{
        cleanTable();
        list();
    }).catch(e=>console.log(e));
}