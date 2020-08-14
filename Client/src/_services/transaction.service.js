import config from 'config';

export const transactionService = {
    depositar,
    sacar
};

function depositar(idConta, valorDeposito){
    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idConta, valorDeposito })
    };
    return fetch(`${config.apiUrl}/transactions`, requestOptions).then(data => {return data});
}

function sacar(idConta, valorSaque){
    const requestOptions = {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ valorSaque })
    };
    return fetch(`${config.apiUrl}/transactions/${idConta}`, requestOptions).then(data => {return data});
}