<template>
    <div>
        <h2>Cliente: {{user.email}}</h2>
        <router-link to="/login">Logout</router-link>
        <br><br>
        <img v-show="loading" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Agencia</th>
                    <th scope="col">Titular</th>
                    <th scope="col">Banco</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="conta in contas" :key="conta.id">  
                    <td>{{conta.desc_agencia}}</td>
                    <td>{{conta.name}}</td>
                    <td>{{conta.nome_banco}}</td>
                    <td>R${{conta.saldo}}</td>
                    <td><router-link :to="{ name: 'depositar', params: { idConta: conta.id }}">Depositar</router-link></td>
                    <td><router-link :to="{ name: 'sacar', params: { idConta: conta.id }}">Sacar</router-link></td>
                </tr>
            </tbody>
        </table>            
    </div>
</template>

<script>
import { userService } from '../_services';

export default {
    data () {
        return {
            user: {},
            users: [],
            conta:{},
            contas: [],
            loading: false,
        }
    },
    created () {
        this.user = JSON.parse(localStorage.getItem('user'));
        this.loading = true;
        userService.getAll().then(data => {
           this.contas = data; 
           this.loading = false;
        });
    }
};
</script>