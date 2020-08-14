<template>
      <div>
          <h1>Deposito</h1>
          <h5><router-link to="/">Inicio</router-link></h5><br>
          <form @submit.prevent="depositar">
            <div class="form-group">
              <label for="valorDeposito">Valor do Deposito</label>
              R$<input type="number" v-model="valorDeposito" name="valorDeposito" class="form-control" id="valorDeposito" aria-describedby="valorDeposito" placeholder="Valor do Deposito" required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" :disabled="loading">Depositar</button>
              <img v-show="loading" src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
            </div>
            <div v-if="flagSucesso" class="alert alert-success">{{sucess}}</div>
        </form>
      </div>
</template>

<script>
import { transactionService } from '../_services'; 

export default {
    
    data () {
        return {
            valorDeposito: '',
            submitted: false,
            loading: false,
            flagSucesso: false,
            sucess: 'Deposito efetuado com Sucesso'
        }
    },
    created () {
      
    },
    methods:{
        depositar(){
          this.submitted = true;
          if (!this.valorDeposito) {
                return;
          }
          this.loading = true;
          transactionService.depositar(this.$route.params.idConta, this.valorDeposito).then(data => {    
            if(data.status == 200){
                this.flagSucesso = true;
                this.loading = false;
            }
          })
        }
    }
};
</script>