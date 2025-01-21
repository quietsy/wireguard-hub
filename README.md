# wireguard-hub

Boilerplate for [https://virtualize.link/hub/](https://virtualize.link/hub/).

Changes required in:
- `wireguard/templates/server.conf`
- `wireguard/wg_confs/wg1.conf`
- `wireguard/wg_confs/wg2.conf`

Example compose:

```yaml
services:
  wireguard:
    image: lscr.io/linuxserver/wireguard:latest
    container_name: wireguard
    cap_add:
      - NET_ADMIN
    environment:
      - PUID=1000
      - PGID=1000
      - TZ=Etc/UTC
      - SERVERURL=wireguard.domain.com
      - SERVERPORT=51820
      - PEERS=1
      - PEERDNS=auto
      - INTERNAL_SUBNET=10.13.13.0
      - ALLOWEDIPS=0.0.0.0/0
      - LOG_CONFS=true
      - DOCKER_MODS=linuxserver/mods:universal-package-install
      - INSTALL_PACKAGES=ipset
    volumes:
      - ./wireguard:/config
    ports:
      - 51820:51820/udp
    sysctls:
      - net.ipv4.conf.all.src_valid_mark=1
    restart: unless-stopped
```

Example SWAG compose changes required for the unblock web-ui:

```yaml
    volumes:
      - ./wireguard/unblock:/config/unblock
      - ./wireguard/unblock/unblock.subdomain.conf:/config/nginx/proxy-confs/unblock.subdomain.conf:ro
```
