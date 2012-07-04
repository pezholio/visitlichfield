$Id: README.txt,v 1.4 2010/05/03 01:11:12 realityloop Exp $

DESCRIPTION
===========
A user may wish, once nodes are published, to have additional edits go into
moderation rather than immediately showing up.

The Save As Draft module allows you to leave existing revisions of a node
published while new revisions go into draft 'mode' until they are released.

The term 'draft' is merely a unique revision. It isn't a previous revision, 
but a future revision of a node.

USAGE
=====
Administrator (installation):
1. See INSTALL.txt

Users:
1. When modifying a node the user may decide not to publish their current changes
   they can then check the Save As Draft checkbox, and then submit the node.
2. The changes will be stored in a future revision, draft, that can be published at a 
   later date.
3. Every time the node is saved with the Save As Draft checkbox checked, a new 'future'
   revision will be created.
4. Each time the user edits the node the most current revision will be used (even if 
   this is not the 'active' revision)
5. To release a draft the user can simply edit the node, uncheck the Save As Draft
   checkbox and submit the node. They may also use the Secondary Method below.

Secondary Method:
1. Through either the Pending drafts block, or the "Drafts" tab at
   Administer >> Content >> Content, click on the title of a node with pending
   drafts. This will take you to a page showing all the revisions, including drafts, for that
   node.
2. Click on the title of any revision, or draft, to view its contents and check it over.
3. If the changes are found acceptable, click "Publish revision" at the top of
   the post. This will be made the new active revision.

AUTHOR
======
Matt Rice
Brian Gilbert (Drupal 6.x updates)

With much of the code borrowed from the Revision Moderation module by Angela Byron (angie [at] lullabot.com)
