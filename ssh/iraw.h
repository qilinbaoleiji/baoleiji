/*
 *  iraw.h - Header file for raw IPv4 packet routines
 *
 *  Copyright (c) 2003 Claes M. Nyberg <md0claes@mdstud.chalmers.se>
 *  All rights reserved, all wrongs reversed.
 *
 *  Redistribution and use in source and binary forms, with or without
 *  modification, are permitted provided that the following conditions
 *  are met:
 *
 *  1. Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *  2. Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *  3. The name of author may not be used to endorse or promote products
 *     derived from this software without specific prior written permission.
 *
 *  THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
 *  INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 *  AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL
 *  THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 *  PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 *  OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 *  WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 *  OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 *  ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * $Id: iraw.h,v 1.1.1.1 2005/02/27 17:08:48 cmn Exp $
 */   

#ifndef _CMN_IRAW_H
#define _CMN_IRAW_H

#include <stdint.h>
#include <sys/types.h>
#include "config.h"

/* Maximum size in bytes of packet to send */
#ifndef PACKET_MAX_SIZE
#define PACKET_MAX_SIZE     1500
#endif

#ifndef FIXIPLEN
#define SETIPLENFIX(x)      x
#define GETIPLENFIX(x)      x
#else
#define SETIPLENFIX(x)   htons(x)
#define GETIPLENFIX(x)   ntohs(x)
#endif /* FIXIPLEN */

#define IP_PROTO_TCP       0x06
#define IP_PROTO_UDP       0x11
#define IP_PROTO_ICMP      0x1

/*
 * Internet Protocol version 4 header
 */
typedef struct {
#ifdef WORDS_BIGENDIAN
    uint8_t ip_ver :4,  /* IP version */
    ip_hlen: 4;        /* Header length in (4 byte) words */
#else
    uint8_t ip_hlen :4, /* Header length in (4 byte) words */
    ip_ver: 4;         /* IP version */
#endif
    uint8_t ip_tos;      /* Type of service */
    uint16_t ip_tlen;    /* Datagram total length */
    uint16_t ip_id;      /* Identification number */
#ifdef WORDS_BIGENDIAN
    uint16_t ip_flgs: 3, /* Fragmentation flags */
    ip_off: 13;         /* Fragment offset */
#else
    uint16_t ip_off: 13, /* Fragment offset */
    ip_flgs: 3;         /* Fragmentation flags */
#endif
    uint8_t ip_ttl;      /* Time to live */
    uint8_t ip_prot;     /* Transport layer protocol (ICMP=1, TCP=6, UDP=17) */
    uint16_t ip_sum;     /* Checksum */
    uint32_t ip_sadd;      /* Source address */
    uint32_t ip_dadd;      /* Destination address */
} IPv4_hdr __attribute__((packed));

/*
 * Transmission Control Protocol header
 */
typedef struct {
    uint16_t tcp_sprt;    /* Source port */
    uint16_t tcp_dprt;    /* Destination port */
    uint32_t tcp_seq;       /* Sequence number */
    uint32_t tcp_ack;       /* Acknowledgement number */
#ifdef WORDS_BIGENDIAN
    uint8_t tcp_hlen: 4,  /* Header length */
    tcp_zero: 4;         /* Unused, should be zero */
#else
    uint8_t tcp_zero: 4,  /* Unused, should be zero */
    tcp_hlen: 4;         /* Header length */
#endif
    uint8_t tcp_flgs;     /* 6 bit control flags, see below */
    uint16_t tcp_win;     /* Size of sliding window */
    uint16_t tcp_sum;     /* Checksum */
    uint16_t tcp_urg;     /* Urgent pointer (if URG flag is set) */
} TCP_hdr __attribute__((packed));

/*
 * User Datagram Protocol Header
 */
typedef struct {
    uint16_t udp_sprt;    /* Source port */
    uint16_t udp_dprt;    /* Destination port */
    uint16_t udp_len;     /* Length of UDP header including data */
    uint16_t udp_sum;     /* Checksum */
} UDP_hdr __attribute__((packed));

/*
 * Checksum header
 * Used for UDP and TCP checksum calculations.
 * W. Richard stevens TCP/IP illustrated Vol 1 page 145.
 */
typedef struct {
    uint32_t phd_saddr;    /* Source address */
    uint32_t phd_daddr;    /* Destination address */
    uint8_t phd_zero;    /* Zero byte */
    uint8_t phd_proto;   /* Protocol code */
    uint16_t phd_hlen;   /* Length of TCP/UDP header */
} Pseudo_hdr __attribute__((packed));

/*
 * Internet Control Message Protocol Header
 * See W. Richard Stevens TCP/IP illustrated Vol 1 page 69->85.
 */
typedef struct {
    uint8_t icmp_type;
    uint8_t icmp_code;
    uint16_t icmp_sum;
    union {
        struct {
            uint16_t id;
            uint16_t seq;
        } icmp_echo;
        uint32_t gw;    /* gateway if type is 5 */
    } icmp_u32;
} ICMP_hdr __attribute__((packed));


/* iraw.c */
extern int iraw_add_ipv4(uint8_t *, uint8_t, uint16_t, uint8_t, uint32_t, uint32_t);
extern int iraw_add_tcp(uint8_t *, uint16_t, uint16_t, uint32_t, uint32_t, uint8_t, uint8_t *, uint16_t);
extern int iraw_add_udp(uint8_t *, uint16_t, uint16_t, uint8_t *, uint16_t);
extern int iraw_add_icmp(uint8_t *packet, uint8_t, uint8_t, uint16_t, uint16_t, uint8_t *, uint32_t);
extern int iraw_send_packet(int, uint8_t *);
#define iraw_printpkt(packet, resolve, verbose)	iraw_fprintpkt(stdout, packet, resolve, verbose)
extern int iraw_fprintpkt(FILE *, uint8_t *, int, unsigned char);

#endif /* _IRAW_H */
