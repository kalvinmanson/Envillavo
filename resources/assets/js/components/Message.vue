<template>
  <div class="card card-success">
    <div class="card-body p-0">
        <div class="scrolleable" v-chat-scroll>
          <div v-for="message in messages">
            <div class="chatMessage" v-bind:class="{ admin: message.admin }">
                <small class="text-muted">{{ message.chat }}</small>
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <form @submit.prevent.keyup="sent">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="escribenos..." v-model="message.chat" required>
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-paper-plane"></i></button>
          </div>
        </div>
      </form>
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
