<template>
      <div>
          <h1>Saque</h1>
          <h5><router-link to="/">Inicio</router-link></h5><br>
          <form @submit.prevent="sacar">
            <div class="form-group">
              <label for="valorSaque">Valor do Saque</label>
              <input type="number" v-model="valorSaque" name="valorSaque" class="form-control" id="valorSaque" aria-describedby="valorSaque" placeholder="Valor do Saque" required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" :disabled="loading">Sacar</button>
              <img v-show="loading" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
            </div>
            <div v-if="flagSucesso" class="alert alert-success">{{sucess}}</div>
            <div v-if="semSaldo" class="alert alert-danger">{{fail}}</div>
        </form>
      </div>
</template>

<script>
import { transactionService } from '../_services'; 

export default {
    
    data () {
        return {
            valorSaque: '',
            submitted: false,
            loading: false,
            flagSucesso: false,
            sucess: 'Saque efetuado com Sucesso',
            fail: 'Você não possui saldo para efetuar essa transação.',
            semSaldo: false
        }
    },
    created () {
      
    },
    methods:{
        sacar(){
          this.submitted = true;
          if (!this.valorSaque) {
                return;
          }
          this.loading = true;
          transactionService.sacar(this.$route.params.idConta, this.valorSaque).then(data => {
            if(data.status == 200){
                this.flagSucesso = true;
                this.loading = false;
            }else if(data.status == 422){
                this.flagSucesso = false;
                this.loading = false;
                this.semSaldo = true;
            }
          })
        }
    }
};
</script>