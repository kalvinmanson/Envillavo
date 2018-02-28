<template>
  <div>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" v-for="message in messages">
            <div class="panel-heading"><strong>{{ message.record.name }}</strong></div>
            <div class="panel-body">
                <p>{{ message.chat }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-footer">
                <form @submit.prevent.keyup="sent">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="message.chat">
                    </div>
                    <div class="form-group">
                        <button type="submit" class=" btn btn-primary">Enviar mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: ['record'],
        data() {
            return {
              last: 0,
              messages: [],
              message: {
                  chat: '',
                  record: this.record
              }
            }
        },
        mounted() {
          this.getNewMessages();
        },
        methods: {
            sent () {
              axios.post('/chats/'+this.message.record.id, this.message).then(response => {
                  console.log(response.data)
                  this.messages.push(response.data)
                  this.last = response.data.id;
              })
              this.message = {
                record: this.record
              }
            },
            fetchMessages(last) {
                let urldata = '/chats/'+this.record.id+'/'+this.last;
                axios.get(urldata).then(response => {
                  //this.messages = response.data
                  //console.log(response.data.length);
                  response.data.forEach(function(e){
                    this.messages.push(e)
                    this.last = e.id;
                  }.bind(this));
                })
            },
            getNewMessages() {
              this.fetchMessages(this.last);
              setInterval(function () {
                this.fetchMessages(this.last)
              }.bind(this), 3000);
            }
        }
    }
</script>

<style scoped>
    .panel{
        margin-bottom: 0;
    }

</style>
