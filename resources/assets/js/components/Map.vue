<template>
  <div>
  <gmap-map
    :center="center"
    :zoom="15"
    style="width: 100%; height: 300px"
  >
    <gmap-marker
      :position="marker.position"
      :clickable="true"
      :draggable="true"
      @click="center=marker.position"
      @dragend="saludar($event.latLng)"
    ></gmap-marker>
  </gmap-map>
  <input type="hidden" name="lat" v-model="lat">
  <input type="hidden" name="lng" v-model="lng">
  </div>
</template>

<script>
  /////////////////////////////////////////
  // New in 0.4.0
  import * as VueGoogleMaps from 'vue2-google-maps';
  import Vue from 'vue';

  Vue.use(VueGoogleMaps, {
    load: {
      key: 'YOUR_API_TOKEN',
      v: 'OPTIONAL VERSION NUMBER',
      // libraries: 'places', //// If you need to use place input
    }
  });

  export default {
    props: ['initlat', 'initlng'],
    data () {
      return {
        lat: 0,
        lng: 0,
        center: {lat: 4.140022673807145, lng: -73.62577114105227},
        marker: {
          position: {lat: 4.140022673807145, lng: -73.62577114105227}
        }
      }
    },
    mounted() {
      if(this.initlat != 0 && this.initlng != 0) {
        this.center = {
          lat: this.initlat,
          lng: this.initlng
        };
        this.marker.position.lat = this.initlat;
        this.marker.position.lng = this.initlng;
        this.lat = this.initlat;
        this.lng = this.initlng;
      } else {
        this.geolocate();
      }

    },
    methods: {
      saludar(pos) {
        this.lat = pos.lat()
        this.lng = pos.lng()
      },
      geolocate: function() {
        navigator.geolocation.getCurrentPosition(position => {
          this.center = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          this.marker.position.lat = position.coords.latitude;
          this.marker.position.lng = position.coords.longitude;
          this.lat = position.coords.latitude;
          this.lng = position.coords.longitude;
        });
      }
    }
  }
</script>
